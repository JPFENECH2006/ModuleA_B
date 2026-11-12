const BASE='http://127.0.0.1:8001';
// BUGS: wrong IDs, wrong DOM API property, missing preventDefault
const form=document.querySelector('#search-form');
form.addEventListener('submit',async event=>{
 const search=document.querySelector('#search').text.trim().toLowerCase();
 const response=await fetch(`${BASE}/api/recipes?page=1`);
 const data=await response.json();
 const results=document.querySelector('#result');
 data.data.filter(r=>r.title.toLowerCase().includes(search)).forEach(r=>{results.innerHTML+=`<p>${r.title}</p>`;});
});
