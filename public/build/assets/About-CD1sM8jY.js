import{T as c,o as d,g as _,a as l,u as t,w as g,F as v,Z as b,b as s,d as n,v as m,e as h,p as f,q as x}from"./index.esm-BSd0a89p.js";import{M as S}from"./MainLayout-DoVnhuLV.js";import{I as u}from"./InputError-DCZ6rp5i.js";import{_ as k}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./Navigation-DHCB5LAN.js";/* empty css                                                                   */import"./CartSidebar-D12dIBYV.js";/* empty css                                                                    *//* empty css                                                                   *//* empty css                                                                   */const w="/build/assets/brush-stroke-2-C5Ycymr5.svg",I="/build/assets/brush-stroke-3-D-pa3AFU.svg",V="/build/assets/artis-port-masked-Cl5Vqolc.svg",i=r=>(f("data-v-43036089"),r=r(),x(),r),q=i(()=>s("img",{class:"brush-stroke-1",src:w},null,-1)),y=i(()=>s("img",{class:"brush-stroke-2",src:I},null,-1)),A=i(()=>s("div",{class:"about-container"},[s("div",{class:"inner-container"},[s("div",{class:"about-text"},[s("h2",null,"Par Arti Daugatu"),s("div",{class:"text-seperator"}),s("p",null," Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga, repudiandae eum nihil earum, omnis aperiam animi corporis, perspiciatis in provident inventore vel iste cum "),s("p",null," voluptates corrupti amet fugit atque harum excepturi! Sapiente iste, eius maxime quas eligendi fuga! Corporis eaque repellendus odio voluptatem blanditiis ipsum ad commodi nemo quis. Sapiente. ")]),s("div",{class:"about-image"},[s("img",{src:V,alt:""})])])],-1)),C=i(()=>s("h3",null,"Sazinies",-1)),F={class:"input-grid"},M={class:"name-input"},U={class:"email-input"},B=i(()=>s("button",{class:"w-full btn-primary",type:"submit"},"Nosutīt",-1)),D={__name:"About",setup(r){const e=c({name:"",email:"",message:""}),p=()=>{e.post("/send-message",{onSuccess:()=>{e.reset()}})};return(E,a)=>(d(),_(v,null,[l(t(b),{title:"Panelis"}),l(S,null,{default:g(()=>[q,y,A,s("form",{class:"form-container",onSubmit:h(p,["prevent"]),id:"contact-form"},[C,s("div",F,[s("div",M,[l(u,{message:t(e).errors.name,class:"mt-2"},null,8,["message"]),n(s("input",{type:"text","onUpdate:modelValue":a[0]||(a[0]=o=>t(e).name=o),placeholder:"Jūsu Vārds",autocomplete:"name"},null,512),[[m,t(e).name]])]),s("div",U,[l(u,{message:t(e).errors.email,class:"mt-2"},null,8,["message"]),n(s("input",{type:"email","onUpdate:modelValue":a[1]||(a[1]=o=>t(e).email=o),placeholder:"Jūsu Epasts",autocomplete:"email"},null,512),[[m,t(e).email]])]),n(s("textarea",{"onUpdate:modelValue":a[2]||(a[2]=o=>t(e).message=o),class:"message-input",rows:3,placeholder:"Ievadiet Savu Ziņu"},null,512),[[m,t(e).message]])]),B],32)]),_:1})],64))}},H=k(D,[["__scopeId","data-v-43036089"]]);export{H as default};
