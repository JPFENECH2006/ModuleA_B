'use strict';
const BASE='http://127.0.0.1:8001';
const form=document.querySelector('#searchForm'),results=document.querySelector('#results'),status=document.querySelector('#status');
form.addEventListener('submit',async event=>{
 event.preventDefault();results.replaceChildren();status.textContent='Searching...';
 const search=document.querySelector('#search').value.trim().toLowerCase();
 try{
  const response=await fetch(`${BASE}/api/recipes?page=1`,{headers:{Accept:'application/json'}});
  if(!response.ok)throw Error(`HTTP ${response.status}`);
  const data=await response.json();
  const found=data.data.filter(r=>r.title.toLowerCase().includes(search));
  for(const r of found){const item=document.createElement('article');item.className='card';const h=document.createElement('h3');h.textContent=r.title;item.append(h);results.append(item);}
  status.textContent=found.length?`${found.length} match(es)`:'No matching recipes.';
 }catch(err){status.textContent=`Error: ${err.message}`;}
});
