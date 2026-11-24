try{ lucide.createIcons(); }catch(e){}

// Hero slider
(function(){
  const hero=document.getElementById('hero');
  if(!hero) return;
  const slides=[...hero.querySelectorAll('.slide')], dots=hero.querySelector('.dots');
  if(!slides.length) return;
  let i=0, t;
  slides.forEach((_,k)=>{const b=document.createElement('button');b.setAttribute('aria-label','Слайд '+(k+1));b.onclick=()=>go(k);dots.appendChild(b)});
  const db=[...dots.children];
  function go(n){slides[i].classList.remove('on');db[i].classList.remove('on');i=(n+slides.length)%slides.length;slides[i].classList.add('on');db[i].classList.add('on');restart()}
  function restart(){clearInterval(t);if(slides.length>1)t=setInterval(()=>go(i+1),6000)}
  hero.querySelector('.prev').onclick=()=>go(i-1);
  hero.querySelector('.next').onclick=()=>go(i+1);
  let x0=null;
  hero.addEventListener('touchstart',e=>x0=e.touches[0].clientX,{passive:true});
  hero.addEventListener('touchend',e=>{if(x0===null)return;const dx=e.changedTouches[0].clientX-x0;if(Math.abs(dx)>40)go(i+(dx<0?1:-1));x0=null});
  db[0].classList.add('on'); restart();
})();

// Products carousel
(function(){
  const tr=document.getElementById('track');
  if(!tr) return;
  const car=tr.parentElement;
  const step=()=>tr.querySelector('.card').offsetWidth+16;
  car.querySelector('.prev').onclick=()=>tr.scrollBy({left:-step(),behavior:'smooth'});
  car.querySelector('.next').onclick=()=>tr.scrollBy({left:step(),behavior:'smooth'});
})();

// FAQ accordion
document.querySelectorAll('.qa').forEach(q=>{
  const a=q.querySelector('.ans');
  if(q.classList.contains('open')) a.style.maxHeight=a.scrollHeight+'px';
  q.querySelector('button').onclick=()=>{
    const open=q.classList.toggle('open');
    a.style.maxHeight=open?a.scrollHeight+'px':0;
  };
});

// Contacts: city switch
document.querySelectorAll('.city').forEach(c=>c.onclick=()=>{
  document.querySelectorAll('.city').forEach(x=>x.classList.remove('on'));
  c.classList.add('on');
  document.getElementById('map').src='https://maps.google.com/maps?q='+encodeURIComponent(c.dataset.q)+'&z='+(c.dataset.q.length>20?15:12)+'&output=embed';
});

// Form → WordPress (admin «Заявки» + e-mail)
(function(){
  const f=document.getElementById('qform');
  if(!f||!window.S24) return;
  const ok=document.getElementById('qok'), err=document.getElementById('qerr'), btn=f.querySelector('.send');
  const show=(el,txt)=>{ok.style.display='none';err.style.display='none';if(el){el.textContent=txt;el.style.display='block'}};
  f.addEventListener('submit',async e=>{
    e.preventDefault();
    const name=f.elements.name.value.trim(), digits=f.elements.phone.value.replace(/\D/g,'');
    if(!name){show(err,"Вкажіть ім'я.");f.elements.name.focus();return}
    if(digits.length<9||digits.length>15){show(err,'Вкажіть телефон, наприклад +38 093 123 4567.');f.elements.phone.focus();return}
    const fd=new FormData(f);
    fd.append('action','s24_lead');fd.append('nonce',S24.nonce);fd.append('page',location.href);
    btn.disabled=true;show(null);
    try{
      const r=await fetch(S24.ajax,{method:'POST',body:fd,credentials:'same-origin'});
      const j=await r.json().catch(()=>null);
      if(j&&j.success){show(ok,(j.data&&j.data.message)||'Дякуємо!');f.reset()}
      else show(err,(j&&j.data&&j.data.message)||'Не вдалося відправити. Зателефонуйте нам, будь ласка.');
    }catch(_){show(err,'Немає зʼєднання. Спробуйте ще раз або зателефонуйте.')}
    btn.disabled=false;
  });
})();

// Mobile drawer
(function(){
  const dr=document.getElementById('drawer'), b=document.getElementById('burger');
  if(!dr||!b) return;
  b.onclick=()=>dr.classList.add('open');
  dr.querySelectorAll('[data-close]').forEach(x=>x.addEventListener('click',()=>dr.classList.remove('open')));
})();

// To top
(function(){
  const tt=document.getElementById('totop');
  if(!tt) return;
  addEventListener('scroll',()=>tt.classList.toggle('show',scrollY>700),{passive:true});
  tt.onclick=()=>scrollTo({top:0,behavior:'smooth'});
})();
