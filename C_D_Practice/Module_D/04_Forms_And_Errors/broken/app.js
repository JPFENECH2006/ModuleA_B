const API='http://127.0.0.1:8001';
document.querySelector('#booking').addEventListener('submit',async e=>{
 // BUG: form reloads; missing preventDefault
 const payload={recipe_id:document.querySelector('#recipe').value,name:document.querySelector('#name').value,email:document.querySelector('#email').value,class_date:document.querySelector('#date').value,people:document.querySelector('#people').value};
 const res=await fetch(`${API}/api/bookings`,{method:'GET',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)}); // BUG: GET with body
 const data=await res.json();
 document.querySelector('#status').textContent='Booking saved: '+data.id;
});
