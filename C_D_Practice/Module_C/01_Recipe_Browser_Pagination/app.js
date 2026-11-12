'use strict';
const API_BASE='http://127.0.0.1:8001';
const cards=document.querySelector('#cards'), status=document.querySelector('#status');
const pageText=document.querySelector('#pageText'), count=document.querySelector('#count');
const previous=document.querySelector('#previous'), next=document.querySelector('#next');
const detail=document.querySelector('#detail'), detailContent=document.querySelector('#detailContent');
let page=1,total=0;
const make=(tag,text)=>{const el=document.createElement(tag);el.textContent=text;return el;};
async function getJson(url){const res=await fetch(url,{headers:{Accept:'application/json'}});if(!res.ok)throw new Error(`HTTP ${res.status}`);return res.json();}
async function loadPage(){
 status.textContent='Loading recipes...';cards.replaceChildren();
 try{
  const result=await getJson(`${API_BASE}/api/recipes?page=${page}`);
  total=result.total;page=result.page;
  count.textContent=`${total} recipes`;pageText.textContent=`Page ${page} of ${Math.max(1,Math.ceil(total/10))}`;
  previous.disabled=page<=1;next.disabled=page>=Math.ceil(total/10);
  result.data.forEach(recipe=>{
   const card=make('article','');card.className='card';card.append(make('h3',recipe.title),make('p',recipe.cuisine),make('p',`Total: ${recipe.total_minutes} minutes`));
   const btn=make('button','View recipe');btn.addEventListener('click',()=>loadDetail(recipe.id));card.append(btn);cards.append(card);
  });
  status.textContent=result.data.length?'':'No recipes on this page.';
 }catch(err){status.textContent=`Cannot load recipes: ${err.message}. Is the mock server running?`;previous.disabled=true;next.disabled=true;}
}
async function loadDetail(id){
 detail.hidden=false;detailContent.replaceChildren(make('p','Loading recipe...'));
 try{
  const r=await getJson(`${API_BASE}/api/recipes/${id}`);
  const ingredients=make('ul',''),method=make('ol','');
  r.ingredients.forEach(x=>ingredients.append(make('li',x)));
  r.method.forEach(x=>method.append(make('li',x)));
  detailContent.replaceChildren(make('h3',r.title),make('p',r.summary),make('p',`Prep ${r.prep_minutes}m • Cook ${r.cook_minutes}m • Total ${r.total_minutes}m`),make('h4','Ingredients'),ingredients,make('h4','Method'),method);
 }catch(err){detailContent.replaceChildren(make('p',`Could not load details: ${err.message}`));}
 detail.scrollIntoView({behavior:'smooth'});
}
previous.addEventListener('click',()=>{if(page>1){page--;loadPage();}});
next.addEventListener('click',()=>{if(page*10<total){page++;loadPage();}});
document.querySelector('#close').addEventListener('click',()=>{detail.hidden=true;});
loadPage();
