const BASE='http://127.0.0.1:8001';let token='';
document.querySelector('#login').addEventListener('submit',async e=>{
 e.preventDefault();
 const res=await fetch(`${BASE}/api/login`,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({email:document.querySelector('#email').value,password:document.querySelector('#password').value})});
 const result=await res.json();token=result.access_token; // BUG: API returns `token`
 document.querySelector('#status').textContent='Logged in';
});
document.querySelector('#load').addEventListener('click',async()=>{
 const response=await fetch(`${BASE}/api/favourites`,{headers:{Authorization:token}}); // BUG: Bearer prefix missing
 document.querySelector('#output').textContent=JSON.stringify(await response.json(),null,2);
});
document.querySelector('#add').addEventListener('click',async()=>{
 const response=await fetch(`${BASE}/api/favourites`,{method:'POST',headers:{Authorization:token},body:{recipe_id:document.querySelector('#recipe').value}}); // BUG: not JSON body / headers
 document.querySelector('#output').textContent=JSON.stringify(await response.json(),null,2);
});
