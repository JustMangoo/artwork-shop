import{T as _,o as w,c as f,w as m,a,u as o,Z as g,b as s,d as p,v as n,i as b,j as h,e as v,p as V,q as x}from"./index.esm-BSd0a89p.js";import{M as y}from"./MainLayout-DoVnhuLV.js";import{I as d}from"./InputError-DCZ6rp5i.js";import{_ as I}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./Navigation-DHCB5LAN.js";/* empty css                                                                   */import"./CartSidebar-D12dIBYV.js";/* empty css                                                                    *//* empty css                                                                   *//* empty css                                                                   */const l=i=>(V("data-v-00784055"),i=i(),x(),i),q={class:"input-wrapper"},M=l(()=>s("label",{for:"name"},"Vārds",-1)),R={class:"input-wrapper"},S=l(()=>s("label",{for:"email"},"Epasts",-1)),U={class:"input-wrapper"},j=l(()=>s("label",{for:"password"},"Parole",-1)),B={class:"input-wrapper"},E=l(()=>s("label",{for:"password_confirmation"},"Apstiprināt Paroli",-1)),N={class:"input-wrapper"},T={class:"input-wrapper"},k=["disabled"],P={__name:"Register",setup(i){const e=_({name:"",email:"",password:"",password_confirmation:""}),u=()=>{e.post(route("register"),{onFinish:()=>e.reset("password","password_confirmation")})};return(c,t)=>(w(),f(y,null,{default:m(()=>[a(o(g),{title:"Register"}),s("form",{onSubmit:v(u,["prevent"]),class:"box"},[s("div",q,[M,p(s("input",{id:"name",type:"text","onUpdate:modelValue":t[0]||(t[0]=r=>o(e).name=r),required:"",autofocus:"",autocomplete:"name"},null,512),[[n,o(e).name]]),a(d,{message:o(e).errors.name},null,8,["message"])]),s("div",R,[S,p(s("input",{id:"email",type:"email","onUpdate:modelValue":t[1]||(t[1]=r=>o(e).email=r),required:"",autocomplete:"username"},null,512),[[n,o(e).email]]),a(d,{message:o(e).errors.email},null,8,["message"])]),s("div",U,[j,p(s("input",{id:"password",type:"password","onUpdate:modelValue":t[2]||(t[2]=r=>o(e).password=r),required:"",autocomplete:"new-password"},null,512),[[n,o(e).password]]),a(d,{message:o(e).errors.password},null,8,["message"])]),s("div",B,[E,p(s("input",{id:"password_confirmation",type:"password","onUpdate:modelValue":t[3]||(t[3]=r=>o(e).password_confirmation=r),required:"",autocomplete:"new-password"},null,512),[[n,o(e).password_confirmation]]),a(d,{message:o(e).errors.password_confirmation},null,8,["message"])]),s("div",N,[a(o(h),{href:c.route("login")},{default:m(()=>[b(" Esi jau reģisterējies? ")]),_:1},8,["href"])]),s("div",T,[s("button",{class:"w-full btn-primary",disabled:o(e).processing}," Reģisterēties ",8,k)])],32)]),_:1}))}},K=I(P,[["__scopeId","data-v-00784055"]]);export{K as default};
