'use strict';
const API='http://127.0.0.1:8001';const $=s=>document.querySelector(s);
$('#date').value=new Date(Date.now()+2*86400000).toISOString().slice(0,10);
$('#booking').addEventListener('submit',async e=>{
 e.preventDefault();document.querySelectorAll('[data-error]').forEach(n=>n.textContent='');$('#status').textContent='Submitting...';
 const payload={recipe_id:Number($('#recipe').value),name:$('#name').value.trim(),email:$('#email').value.trim(),date:$('#date').value,people:Number($('#people').value)};
 try{
  const res=await fetch(`${API}/api/bookings`,{method:'POST',headers:{Accept:'application/json','Content-Type':'application/json'},body:JSON.stringify(payload)});
  const data=await res.json();
  if(res.status===422){Object.entries(data.errors||{}).forEach(([key,messages])=>{const label=document.querySelector(`[data-error="${key}"]`);if(label)label.textContent=messages.join(' ');});$('#status').textContent='Please fix the highlighted errors.';return;}
  if(!res.ok)throw Error(data.message||`HTTP ${res.status}`);
  $('#status').textContent=`Booking saved: #${data.id}`;
 }catch(err){$('#status').textContent=`Error: ${err.message}`;}
});
