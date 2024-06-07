import{Z as g,s as d,o as r,g as c,a as l,w as h,F as u,b as t,l as _,t as n,d as y,v as f,p as I,q as v}from"./index.esm-BSd0a89p.js";import{M as q}from"./MainLayout-DoVnhuLV.js";import{_ as C}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./Navigation-DHCB5LAN.js";/* empty css                                                                   */import"./CartSidebar-D12dIBYV.js";/* empty css                                                                    */import"./InputError-DCZ6rp5i.js";/* empty css                                                                   *//* empty css                                                                   */const P={components:{MainLayout:q,Head:g},data(){return{product:this.$page.props.product,quantity:1,selectedImage:""}},computed:{productImagePath(){return e=>e.image?"/storage/"+e.image.replace("public/",""):"resources/js/Assets/Images/Image1.png"}},methods:{selectImage(e){this.selectedImage=this.productImagePath(e)},addToCart(){this.$inertia.post("/cart",{product_id:this.product.id,quantity:this.quantity},{onError:e=>{console.error("Error adding to cart:",e)},onSuccess:()=>{console.log("Added to cart successfully!")}})},increaseQuantity(){this.quantity<5&&this.quantity++},decreaseQuantity(){this.quantity>1&&this.quantity--}},mounted(){this.product.images.length>0&&this.selectImage(this.product.images[0])},watch:{"product.images":function(e){e.length>0&&this.selectImage(e[0])}}},b=e=>(I("data-v-89d5683d"),e=e(),v(),e),k={class:"container"},x={class:"inner-container"},Q={class:"images-section"},S={class:"thumbnail-images"},w=["src","alt","onClick"],M={class:"main-image-container"},D=["src"],L={class:"product-details"},T=b(()=>t("hr",null,null,-1)),B={class:"price"},E={class:"quantity-control"};function H(e,o,V,A,i,a){const p=d("Head"),m=d("MainLayout");return r(),c(u,null,[l(p,{title:"Product Details"}),l(m,null,{default:h(()=>[t("div",k,[t("div",x,[t("div",Q,[t("div",S,[(r(!0),c(u,null,_(i.product.images,s=>(r(),c("img",{key:s.id,src:a.productImagePath(s),alt:i.product.title,class:"thumbnail-image",onClick:F=>a.selectImage(s)},null,8,w))),128))]),t("div",M,[t("img",{src:i.selectedImage,alt:"Selected Product Image",class:"main-image"},null,8,D)])]),t("div",L,[t("h1",null,n(i.product.title),1),t("p",null,n(i.product.category.name),1),t("p",null,n(i.product.description),1),T,t("p",B,"€"+n(i.product.price),1),t("div",E,[t("button",{onClick:o[0]||(o[0]=(...s)=>a.decreaseQuantity&&a.decreaseQuantity(...s))},"-"),y(t("input",{type:"text","onUpdate:modelValue":o[1]||(o[1]=s=>i.quantity=s),readonly:""},null,512),[[f,i.quantity]]),t("button",{onClick:o[2]||(o[2]=(...s)=>a.increaseQuantity&&a.increaseQuantity(...s))},"+")]),t("button",{class:"w-full btn-primary",onClick:o[3]||(o[3]=(...s)=>a.addToCart&&a.addToCart(...s))}," Pievienot Grozam ")])])])]),_:1})],64)}const W=C(P,[["render",H],["__scopeId","data-v-89d5683d"]]);export{W as default};
