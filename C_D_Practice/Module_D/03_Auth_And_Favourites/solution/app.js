'use strict';
const BASE='http://127.0.0.1:8001';let token=null;
const $=s=>document.querySelector(s);
$('#login').addEventListener('submit',async e=>{
 e.preventDefault();$('#status').textContent='Logging in...';
 try{
  const res=await fetch(`${BASE}/api/login`,{method:'POST',headers:{Accept:'application/json','Content-Type':'application/json'},body:JSON.stringify({email:$('#email').value,password:$('#password').value})});
  const result=await res.json();if(!res.ok)throw Error(result.message||`HTTP ${res.status}`);
  token=result.token;$('#status').textContent='Logged in (token stored in memory).';
 }catch(err){$('#status').textContent=err.message;}
});
$('#load').addEventListener('click',async()=>{
 try{const response=await fetch(`${BASE}/api/favourites`,{headers:{Accept:'application/json',Authorization:`Bearer ${token||''}`}});
  const result=await response.json();if(!response.ok)throw Error(result.message||`HTTP ${response.status}`);
  $('#output').textContent=JSON.stringify(result,null,2);
 }catch(err){$('#status').textContent=err.message;}
});
$('#add').addEventListener('click',async()=>{
 try{const response=await fetch(`${BASE}/api/favourites`,{method:'POST',headers:{Accept:'application/json','Content-Type':'application/json',Authorization:`Bearer ${token||''}`},body:JSON.stringify({recipe_id:Number($('#recipe').value)})});
  const result=await response.json();if(!response.ok)throw Error(result.message||`HTTP ${response.status}`);
  $('#output').textContent=JSON.stringify(result,null,2);$('#status').textContent='Favourite added.';
 }catch(err){$('#status').textContent=err.message;}
});
