'use strict';
// THIS ENDPOINT IS FICTIONAL PRACTICE; it does not appear in real Module B.
const API_BASE='http://127.0.0.1:8001';
const $=selector=>document.querySelector(selector);
const form=$('#form'),submit=$('#submit'),status=$('#status');
$('#date').min=new Date(Date.now()+86400000).toISOString().slice(0,10);
function errorsFor(name,message){const e=document.querySelector(`[data-error="${name}"]`);if(e)e.textContent=message;}
async function loadOptions(){
 try{
  const response=await fetch(`${API_BASE}/api/recipes?page=1`);if(!response.ok)throw Error('Could not load recipes');
  const result=await response.json();
  result.data.forEach(r=>{const option=document.createElement('option');option.value=r.id;option.textContent=r.title;$('#recipeId').append(option);});
 }catch(e){status.textContent='Cannot load recipes. Start the mock API server.';}
}
form.addEventListener('submit',async event=>{
 event.preventDefault();document.querySelectorAll('[data-error]').forEach(n=>n.textContent='');status.textContent='Submitting...';submit.disabled=true;
 const body={recipe_id:Number($('#recipeId').value),name:$('#name').value.trim(),email:$('#email').value.trim(),date:$('#date').value,people:Number($('#people').value)};
 try{
  const response=await fetch(`${API_BASE}/api/bookings`,{method:'POST',headers:{Accept:'application/json','Content-Type':'application/json'},body:JSON.stringify(body)});
  const data=await response.json();
  if(response.status===422){Object.entries(data.errors||{}).forEach(([key,arr])=>errorsFor(key,arr.join(' ')));status.textContent=data.message||'Please correct the errors.';return;}
  if(!response.ok)throw Error(data.message||`HTTP ${response.status}`);
  status.textContent=`Booking #${data.id} saved successfully.`;status.className='status success';form.reset();
 }catch(e){status.textContent=`Failed: ${e.message}`;}
 finally{submit.disabled=false;}
});
loadOptions();
