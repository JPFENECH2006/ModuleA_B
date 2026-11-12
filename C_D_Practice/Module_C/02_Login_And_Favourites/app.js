'use strict';
const API_BASE='http://127.0.0.1:8001';
let token=null; // Keep demo token only in memory; don't log it or save to a public file.
const $=selector=>document.querySelector(selector);
const make=(tag,text)=>{const el=document.createElement(tag);el.textContent=text;return el;};
async function call(path,method='GET',body=null,protectedRoute=false){
 const headers={Accept:'application/json'};
 if(body!==null)headers['Content-Type']='application/json';
 if(protectedRoute&&token)headers.Authorization=`Bearer ${token}`;
 const res=await fetch(`${API_BASE}${path}`,{method,headers,...(body!==null?{body:JSON.stringify(body)}:{})});
 const data=res.status===204?null:await res.json();
 if(!res.ok){const message=data?.message||`HTTP ${res.status}`;throw new Error(`${res.status} ${message}`);}
 return data;
}
$('#loginForm').addEventListener('submit',async e=>{
 e.preventDefault();$('#loginStatus').textContent='Signing in...';
 try{const data=await call('/api/login','POST',{email:$('#email').value.trim(),password:$('#password').value});
  token=data.token;$('#loginPanel').hidden=true;$('#appPanel').hidden=false;$('#password').value='';await loadFavourites();
 }catch(err){$('#loginStatus').textContent=err.message;}
});
async function loadFavourites(){
 const cards=$('#cards');cards.replaceChildren();$('#appStatus').textContent='Loading favourites...';
 try{const data=await call('/api/favourites','GET',null,true);
  $('#appStatus').textContent=`${data.total} favourite(s)`;$('#empty').textContent=data.total?'':'No favourites yet.';
  data.data.forEach(r=>{const card=make('article','');card.className='card';card.append(make('h3',r.title),make('p',r.cuisine));
   const b=make('button','Remove favourite');b.addEventListener('click',async()=>{
    try{await call(`/api/favourites/${r.id}`,'DELETE',null,true);await loadFavourites();}
    catch(err){$('#appStatus').textContent=err.message;}
   });card.append(b);cards.append(card);
  });
 }catch(err){$('#appStatus').textContent=err.message;}
}
$('#add').addEventListener('click',async()=>{
 $('#appStatus').textContent='Adding favourite...';
 try{await call('/api/favourites','POST',{recipe_id:Number($('#recipeId').value)},true);await loadFavourites();}
 catch(err){$('#appStatus').textContent=err.message;}
});
$('#logout').addEventListener('click',()=>{token=null;$('#appPanel').hidden=true;$('#loginPanel').hidden=false;$('#cards').replaceChildren();});
