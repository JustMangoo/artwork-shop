import{f as y,d as p,B as x,o as n,g as w,T as V,c as m,w as u,a as i,u as t,Z as B,b as s,t as I,h as f,e as S,v as _,j as h,i as q,p as C,q as M}from"./index.esm-BSd0a89p.js";import{M as L}from"./MainLayout-DoVnhuLV.js";import{I as b}from"./InputError-DCZ6rp5i.js";import{_ as v}from"./InputLabel-C5IakI4U.js";import{_ as N}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./Navigation-DHCB5LAN.js";/* empty css                                                                   */import"./CartSidebar-D12dIBYV.js";/* empty css                                                                    *//* empty css                                                                   *//* empty css                                                                   */const P=["value"],U={__name:"Checkbox",props:{checked:{type:[Array,Boolean],required:!0},value:{default:null}},emits:["update:checked"],setup(o,{emit:e}){const l=e,d=o,a=y({get(){return d.checked},set(r){l("update:checked",r)}});return(r,c)=>p((n(),w("input",{type:"checkbox",value:o.value,"onUpdate:modelValue":c[0]||(c[0]=g=>a.value=g),class:"checkboxInput"},null,8,P)),[[x,a.value]])}},k=o=>(C("data-v-7f0408bb"),o=o(),M(),o),A={class:"box"},E={key:0},R={class:"input-wrapper"},T={class:"input-wrapper"},$={class:"input-wrapper"},j={class:"options-container"},z=k(()=>s("span",null,"Atcerēties mani",-1)),D=["disabled"],F=k(()=>s("div",{class:"divider"},"Vai",-1)),Z=["disabled"],G={__name:"Login",props:{canResetPassword:{type:Boolean},status:{type:String}},setup(o){const e=V({email:"",password:"",remember:!1}),l=()=>{e.post(route("login"),{onFinish:()=>e.reset("password")})};return(d,a)=>(n(),m(L,null,{default:u(()=>[i(t(B),{title:"Log in"}),s("div",A,[o.status?(n(),w("div",E,I(o.status),1)):f("",!0),s("form",{onSubmit:S(l,["prevent"])},[s("div",R,[i(v,{for:"email",value:"Epasts"}),p(s("input",{id:"email",type:"email","onUpdate:modelValue":a[0]||(a[0]=r=>t(e).email=r),required:"",autofocus:"",autocomplete:"username"},null,512),[[_,t(e).email]]),i(b,{message:t(e).errors.email},null,8,["message"])]),s("div",T,[i(v,{for:"password",value:"Parole"}),p(s("input",{id:"password",type:"password","onUpdate:modelValue":a[1]||(a[1]=r=>t(e).password=r),required:"",autocomplete:"current-password"},null,512),[[_,t(e).password]]),i(b,{message:t(e).errors.password},null,8,["message"])]),s("div",$,[s("div",j,[s("label",null,[i(U,{name:"remember",checked:t(e).remember,"onUpdate:checked":a[2]||(a[2]=r=>t(e).remember=r)},null,8,["checked"]),z]),o.canResetPassword?(n(),m(t(h),{key:0,href:d.route("password.request")},{default:u(()=>[q(" Aizmirsi savu paroli? ")]),_:1},8,["href"])):f("",!0)])]),s("div",null,[s("button",{class:"w-full btn-primary",disabled:t(e).processing}," Pieslēdzies ",8,D)])],32),F,i(t(h),{href:d.route("register")},{default:u(()=>[s("button",{class:"w-full btn-secondary",disabled:t(e).processing}," Reģisterējies ",8,Z)]),_:1},8,["href"])])]),_:1}))}},oe=N(G,[["__scopeId","data-v-7f0408bb"]]);export{oe as default};