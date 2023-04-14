import{b as e,a as l,n as a,f as t,o,h as d,i as u,Y as r,_ as n,e as i,r as s,U as p,m,w as c,l as f,F as h,p as b,j as _,A as g,B as v}from"./index-2fc42248.js";import{g as V}from"./index-20ea9ccb.js";import{g as w}from"./index-82e737e3.js";import{u as y,W as k}from"./WangEditor-bad4b76e.js";const U=n(e({__name:"ElMdRich",props:{content:{default:""},html:{default:""},richHeight:{default:"300px"},editPreview:{default:"preview"},placeholder:{default:""},autofocus:{type:Boolean,default:!1},width:{default:"100%"}},emits:["update:content"],setup(e,{emit:n}){const i=e,s=l(),p=l(""),m=l("200px"),c=l(!1),f=l("preview"),h=l({bold:!0,italic:!0,header:!0,underline:!0,strikethrough:!0,superscript:!0,subscript:!0,quote:!0,ol:!0,ul:!0,link:!0,imagelink:!0,code:!0,table:!0,fullscreen:!0,readmodel:!0,htmlcode:!0,undo:!0,redo:!0,trash:!0,save:!1,navigation:!0,preview:!0});a((()=>i.editPreview),(e=>{f.value=e,c.value="edit"===e}),{immediate:!0,deep:!0}),a((()=>i.content),(e=>{p.value=e}),{immediate:!0,deep:!0}),a((()=>i.richHeight),(e=>{m.value=e}),{immediate:!0,deep:!0});const b=(e,l)=>{let a=new FormData;a.append("file",l),y(a).then((l=>{s.value.$img2Url(e,l.data.link)}))},_=e=>{n("update:content",e)};return(l,a)=>{const n=t("mavon-editor");return o(),d("div",{class:"rich",style:r({width:e.width})},[u(n,{ref_key:"mavon",ref:s,modelValue:p.value,"onUpdate:modelValue":a[0]||(a[0]=e=>p.value=e),toolbars:h.value,"toolbars-flag":c.value,subfield:"edit"===e.editPreview,"preview-background":"#fff","box-shadow":!0,autofocus:e.autofocus,placeholder:e.placeholder,style:r({height:m.value,width:"100%","z-index":0}),ishljs:!0,"default-open":f.value,onChange:_,onImgAdd:b},null,8,["modelValue","toolbars","toolbars-flag","subfield","autofocus","placeholder","style","default-open"])],4)}}}),[["__scopeId","data-v-a32bde9d"]]),x={class:"app-container"},j=e({name:"Article"}),q=n(e({...j,props:{type:{type:String,required:!0},article:{type:Object,required:!0}},emits:["handleSubmit","update:article","refresh"],setup(e,{emit:a}){const r=e,n=l([]),y=i((()=>{let e=n.value.map((e=>({label:e.name,value:e.id,disabled:e.children.length>0,children:e.children.map((e=>({label:e.name,value:e.id})))})));return e.unshift({label:"请选择分类",value:0,disabled:!1,children:[]}),e})),j=i((()=>r.article)),q=s({title:[{required:!0,message:"标题不能为空",trigger:"blur"}],slug:[{required:!0,message:"标识不能为空",trigger:"blur"},{min:2,max:20,message:"长度必须在 2 到 20 位之间",trigger:"blur"}],keywords:[{required:!0,message:"关键词不能为空",trigger:"blur"}]}),A=l(null),C=()=>{var e;null==(e=A.value)||e.validate((e=>{if(!e)return!1;a("update:article",j.value),a("handleSubmit")}))},I=l([]);p((()=>{V().then((e=>{n.value=e.data})),w().then((e=>{I.value=e.data}))}));const P=m(),S=()=>{P.back()};return(e,l)=>{const a=t("el-tree-select"),r=t("el-form-item"),n=t("el-input"),i=t("el-option"),s=t("el-select"),p=t("el-radio"),m=t("el-radio-group"),V=t("el-input-number"),w=t("el-switch"),P=t("el-form"),B=t("el-button"),E=t("el-card");return o(),d("div",x,[u(E,{shadow:"never"},{default:c((()=>[u(P,{model:f(j),ref_key:"formRef",ref:A,"label-position":"right","label-width":"150px",rules:q},{default:c((()=>[u(r,{label:"分类：",prop:"category_id"},{default:c((()=>[u(a,{modelValue:f(j).category_id,"onUpdate:modelValue":l[0]||(l[0]=e=>f(j).category_id=e),data:f(y),"render-after-expand":!0},null,8,["modelValue","data"])])),_:1}),u(r,{label:"标题：",prop:"title"},{default:c((()=>[u(n,{class:"form-input",modelValue:f(j).title,"onUpdate:modelValue":l[1]||(l[1]=e=>f(j).title=e),placeholder:"请输入标题"},null,8,["modelValue"])])),_:1}),u(r,{label:"标识：",prop:"slug"},{default:c((()=>[u(n,{class:"form-input",modelValue:f(j).slug,"onUpdate:modelValue":l[2]||(l[2]=e=>f(j).slug=e),placeholder:"请输入标识"},null,8,["modelValue"])])),_:1}),u(r,{label:"作者：",prop:"author"},{default:c((()=>[u(n,{class:"form-input",modelValue:f(j).author,"onUpdate:modelValue":l[3]||(l[3]=e=>f(j).author=e),placeholder:"请输入作者"},null,8,["modelValue"])])),_:1}),u(r,{label:"标签：",prop:"tags"},{default:c((()=>[u(s,{modelValue:f(j).tags,"onUpdate:modelValue":l[4]||(l[4]=e=>f(j).tags=e),multiple:"",placeholder:"请选择标签",style:{width:"380px"}},{default:c((()=>[(o(!0),d(h,null,b(I.value,(e=>(o(),_(i,{key:e.id,label:e.name,value:e.id},null,8,["label","value"])))),128))])),_:1},8,["modelValue"])])),_:1}),u(r,{label:"关键词：",prop:"keywords"},{default:c((()=>[u(n,{class:"form-input",modelValue:f(j).keywords,"onUpdate:modelValue":l[5]||(l[5]=e=>f(j).keywords=e),placeholder:"请输入关键词"},null,8,["modelValue"])])),_:1}),u(r,{label:"文本类型：",prop:"content_type"},{default:c((()=>[u(m,{modelValue:f(j).content_type,"onUpdate:modelValue":l[6]||(l[6]=e=>f(j).content_type=e)},{default:c((()=>[u(p,{label:1},{default:c((()=>[g("markdown编辑器")])),_:1}),u(p,{label:2},{default:c((()=>[g("富文本编辑器")])),_:1})])),_:1},8,["modelValue"])])),_:1}),1===f(j).content_type?(o(),_(r,{key:0,label:"内容：",prop:"markdown"},{default:c((()=>[u(U,{content:f(j).markdown,"onUpdate:content":l[7]||(l[7]=e=>f(j).markdown=e),placeholder:"请输入","edit-preview":"edit","rich-height":"400px"},null,8,["content"])])),_:1})):v("",!0),2===f(j).content_type?(o(),_(r,{key:1,label:"内容：",prop:"html"},{default:c((()=>[u(k,{content:f(j).html,"onUpdate:content":l[8]||(l[8]=e=>f(j).html=e)},null,8,["content"])])),_:1})):v("",!0),u(r,{label:"排序：",prop:"order"},{default:c((()=>[u(V,{class:"form-input",modelValue:f(j).order,"onUpdate:modelValue":l[9]||(l[9]=e=>f(j).order=e)},null,8,["modelValue"])])),_:1}),u(r,{label:"描述：",prop:"description"},{default:c((()=>[u(n,{type:"textarea",rows:"6",class:"form-input",modelValue:f(j).description,"onUpdate:modelValue":l[10]||(l[10]=e=>f(j).description=e),placeholder:"请输入描述"},null,8,["modelValue"])])),_:1}),u(r,{label:"是否置顶：",prop:"is_top"},{default:c((()=>[u(w,{modelValue:f(j).is_top,"onUpdate:modelValue":l[11]||(l[11]=e=>f(j).is_top=e)},null,8,["modelValue"])])),_:1}),u(r,{label:"是否显示：",prop:"is_show"},{default:c((()=>[u(w,{modelValue:f(j).is_show,"onUpdate:modelValue":l[12]||(l[12]=e=>f(j).is_show=e)},null,8,["modelValue"])])),_:1}),u(r,{label:"浏览量：",prop:"views"},{default:c((()=>[u(V,{class:"form-input",modelValue:f(j).views,"onUpdate:modelValue":l[13]||(l[13]=e=>f(j).views=e)},null,8,["modelValue"])])),_:1})])),_:1},8,["model","rules"]),u(r,{style:{"padding-left":"150px"}},{default:c((()=>[u(B,{type:"primary",onClick:C},{default:c((()=>[g("保存")])),_:1}),u(B,{style:{"margin-left":"10px"},onClick:S},{default:c((()=>[g("取消")])),_:1})])),_:1})])),_:1})])}}}),[["__scopeId","data-v-09b312c0"]]);export{q as A};
