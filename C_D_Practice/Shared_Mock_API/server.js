'use strict';
// RECIPE PRACTICE API. No dependencies and NO real credentials.
// IMPORTANT: /api/bookings is fictional practice only — not specified by official Module B brief.
const http = require('node:http');
const crypto = require('node:crypto');
const { URL } = require('node:url');
const PORT = Number(process.env.PORT || 8001);
const titles = ['Pastizzi','Rabbit Stew','Imqaret','Timpana','Bragioli','Ftira','Lasagne','Greek Salad','Pizza Margherita','Pasta Pesto','Minestrone','Focaccia','Risotto','Couscous','Baklava','Lemon Chicken'];
const cuisines = ['Maltese','Maltese','Maltese','Maltese','Maltese','Maltese','Italian','Mediterranean','Italian','Italian','Italian','Italian','Italian','Mediterranean','Mediterranean','Mediterranean'];
const recipes = titles.map((title, i) => ({
  id:i+1,title,cuisine:cuisines[i],summary:`A delicious ${cuisines[i].toLowerCase()} recipe: ${title}.`,
  prep_minutes:10+(i%4)*10,cook_minutes:15+(i%5)*10,total_minutes:25+(i%4)*10+(i%5)*10,
  servings:2+(i%5),image:`recipe-${i+1}.jpg`,
  ingredients:['1 cup main ingredient','2 tablespoons seasoning','Salt and pepper'],
  method:['Prepare ingredients.','Cook until ready.','Serve warm.']
}));
const users = [{id:1,email:'demo@example.com',password:'demo1234'}, {id:2,email:'other@example.com',password:'other1234'}];
const tokens = new Map();const favourites=new Map([[1,new Set([4])],[2,new Set([2])]]);const bookings=[];
function send(res,code,data){res.writeHead(code,{'Content-Type':'application/json; charset=utf-8','Access-Control-Allow-Origin':'*','Access-Control-Allow-Headers':'Content-Type, Accept, Authorization','Access-Control-Allow-Methods':'GET,POST,DELETE,OPTIONS'});res.end(code===204?'':JSON.stringify(data));}
function error(res,code,message,errors){send(res,code,{message,...(errors?{errors}:{})});}
function body(req){return new Promise((resolve,reject)=>{let data='';req.on('data',chunk=>{data+=chunk;if(data.length>100000){reject(new Error('Request too large'));req.destroy();}});req.on('end',()=>{try{resolve(data?JSON.parse(data):{});}catch(e){reject(e);}});req.on('error',reject);});}
function listing(data,page=1){return {data,page,total:data.length};}
function userFor(req){const auth=req.headers.authorization||'';const match=/^Bearer (.+)$/.exec(auth);return match?tokens.get(match[1]):undefined;}
function onlyList(r){const {ingredients,method,...list}=r;return list;}
const server=http.createServer(async(req,res)=>{
 try{
  const url=new URL(req.url,`http://localhost:${PORT}`);const pathname=url.pathname;
  if(req.method==='OPTIONS'){return send(res,204,null);}
  if(req.method==='GET'&&pathname==='/api/recipes'){
   const page=Math.max(1,Number.parseInt(url.searchParams.get('page')||'1',10)||1);
   const data=recipes.slice((page-1)*10,page*10).map(onlyList);
   return send(res,200,{data,page,total:recipes.length});
  }
  const recmatch=/^\/api\/recipes\/(\d+)$/.exec(pathname);
  if(req.method==='GET'&&recmatch){const r=recipes.find(r=>r.id===Number(recmatch[1]));return r?send(res,200,r):error(res,404,'Recipe not found.');}
  if(req.method==='POST'&&pathname==='/api/login'){
   const data=await body(req);const errors={};if(!data.email)errors.email=['The email field is required.'];if(!data.password)errors.password=['The password field is required.'];
   if(Object.keys(errors).length)return error(res,422,Object.values(errors)[0][0],errors);
   const u=users.find(u=>u.email===data.email&&u.password===data.password);
   if(!u)return error(res,401,'Invalid credentials.');
   const token=crypto.randomBytes(32).toString('hex');tokens.set(token,u.id);return send(res,200,{token});
  }
  const famatch=/^\/api\/favourites\/(\d+)$/.exec(pathname);
  if(pathname==='/api/favourites'||famatch){
   const uid=userFor(req);if(!uid)return error(res,401,'Unauthorised.');const set=favourites.get(uid)||new Set();
   if(req.method==='GET'&&pathname==='/api/favourites'){
    const page=Math.max(1,Number.parseInt(url.searchParams.get('page')||'1',10)||1);
    const all=recipes.filter(r=>set.has(r.id)).map(onlyList);
    return send(res,200,{data:all.slice((page-1)*10,page*10),page,total:all.length});
   }
   if(req.method==='POST'&&pathname==='/api/favourites'){
    const data=await body(req);const rid=Number(data.recipe_id);const r=recipes.find(r=>r.id===rid);
    if(!Number.isInteger(rid)||!r)return error(res,422,'The selected recipe id is invalid.',{recipe_id:['The selected recipe id is invalid.']});
    set.add(rid);favourites.set(uid,set);return send(res,201,onlyList(r));
   }
   if(req.method==='DELETE'&&famatch){const rid=Number(famatch[1]);if(!set.has(rid))return error(res,404,'Favourite not found.');set.delete(rid);return send(res,204,null);}
  }
  // FICTIONAL practice endpoint, not part of real Module B.
  if(req.method==='POST'&&pathname==='/api/bookings'){
   const data=await body(req);const errors={};const rid=Number(data.recipe_id),p=Number(data.people);
   if(!recipes.some(r=>r.id===rid))errors.recipe_id=['Select an existing recipe.'];
   if(!data.name||!String(data.name).trim())errors.name=['Name is required.'];
   if(!/^\S+@\S+\.\S+$/.test(data.email||''))errors.email=['Email must be valid.'];
   const today=new Date().toISOString().slice(0,10);
   if(!data.date||data.date<=today)errors.date=['Date must be after today.'];
   if(!Number.isInteger(p)||p<1||p>12)errors.people=['People must be between 1 and 12.'];
   if(Object.keys(errors).length)return error(res,422,Object.values(errors)[0][0],errors);
   const booking={id:bookings.length+1,recipe_id:rid,name:data.name,email:data.email,date:data.date,people:p};bookings.push(booking);return send(res,201,booking);
  }
  return error(res,404,'Endpoint not found.');
 }catch(err){return error(res,400,'Invalid JSON or request.');}
});
server.listen(PORT,'127.0.0.1',()=>console.log(`Practice Recipe API: http://127.0.0.1:${PORT}\nDemo login demo@example.com / demo1234`));
