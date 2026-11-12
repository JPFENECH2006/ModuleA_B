'use strict';
const API='http://127.0.0.1:8001';let page=1,total=0;
const $=s=>document.querySelector(s);
async function draw(){
 $('#status').textContent='Loading...';
 try{
  const res=await fetch(`${API}/api/recipes?page=${page}`);
  if(!res.ok)throw Error(`HTTP ${res.status}`);
  const payload=await res.json();total=payload.total;
  $('#items').replaceChildren();
  payload.data.forEach(r=>{const card=document.createElement('article');card.className='card';card.textContent=r.title;$('#items').append(card);});
  $('#label').textContent=`Page ${page}/${Math.ceil(total/10)}`;
  $('#prev').disabled=page<=1;$('#next').disabled=page*10>=total;
  $('#status').textContent=payload.data.length?'':'No recipes on this page.';
 }catch(err){$('#status').textContent=`Error: ${err.message}`;}
}
$('#next').addEventListener('click',()=>{if(page*10<total){page++;draw();}});
$('#prev').addEventListener('click',()=>{if(page>1){page--;draw();}});
draw();
