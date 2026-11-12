const API='http://127.0.0.1:8001';let page=0,total=0;
async function draw(){
 const res=await fetch(`${API}/api/recipes?page=${page}`);
 const recipes=await res.json();
 total=recipes.data.length; // BUG: page count, not all data
 document.querySelector('#items').innerHTML='';
 recipes.forEach(r=>{const p=document.createElement('p');p.textContent=r.title;document.querySelector('#items').append(p);});
 document.querySelector('#label').textContent=`Page ${page}`;
}
document.querySelector('#next').addEventListener('click',()=>{page++;draw();});
document.querySelector('#prev').addEventListener('click',()=>{page--;draw();});
draw();
