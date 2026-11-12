'use strict';
const API_BASE='http://127.0.0.1:8001';
const $=s=>document.querySelector(s);
let allRecipes=[];
const el=(tag,text)=>{const e=document.createElement(tag);e.textContent=text;return e;};
async function fetchAllRecipes(){
 $('#status').textContent='Loading all recipe pages...';
 try{
  const first=await fetch(`${API_BASE}/api/recipes?page=1`);if(!first.ok)throw Error(`HTTP ${first.status}`);
  const result=await first.json();allRecipes=[...result.data];const pages=Math.ceil(result.total/10);
  for(let page=2;page<=pages;page++){
   const res=await fetch(`${API_BASE}/api/recipes?page=${page}`);if(!res.ok)throw Error(`HTTP ${res.status}`);
   const data=await res.json();allRecipes.push(...data.data);
  }
  const cuisines=[...new Set(allRecipes.map(r=>r.cuisine))].sort();
  cuisines.forEach(c=>{const option=el('option',c);option.value=c;$('#cuisine').append(option);});
  $('#status').textContent='';render();
 }catch(error){$('#status').textContent=`Cannot load recipes: ${error.message}`;}
}
function render(){
 const search=$('#search').value.trim().toLocaleLowerCase(),cuisine=$('#cuisine').value,sort=$('#sort').value;
 const found=allRecipes.filter(r=>r.title.toLocaleLowerCase().includes(search)&&(!cuisine||r.cuisine===cuisine));
 if(sort==='time')found.sort((a,b)=>a.total_minutes-b.total_minutes||a.id-b.id);
 else if(sort==='title')found.sort((a,b)=>a.title.localeCompare(b.title));
 else found.sort((a,b)=>a.id-b.id);
 const cards=$('#cards');cards.replaceChildren();$('#summary').textContent=`Showing ${found.length} of ${allRecipes.length} recipes`;
 if(!found.length){$('#status').textContent='No recipes match your search or cuisine.';return;}
 $('#status').textContent='';found.forEach(r=>{const card=el('article','');card.className='card';card.append(el('h3',r.title),el('p',r.cuisine),el('p',`${r.total_minutes} minutes`));cards.append(card);});
}
$('#filters').addEventListener('submit',e=>{e.preventDefault();render();});
$('#reset').addEventListener('click',()=>{$('#search').value='';$('#cuisine').value='';$('#sort').value='id';render();});
fetchAllRecipes();
