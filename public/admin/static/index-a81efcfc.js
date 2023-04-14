import{a7 as e,b as l,a as t,n as a,r as u,j as n,w as o,f as s,o as d,i as r,A as i,_ as p,U as m,h as c,B as v,E as f}from"./index-aa7cad08.js";import{_ as b}from"./TEditor.vue_vue_type_script_setup_true_lang-76994d00.js";const _=l({name:"Site"}),g=l({..._,props:{setting:{type:Object,required:!0}},emits:["update:setting","handleSubmit"],setup(e,{emit:l}){const p=e,m=t({title:"",sub_title:"",keywords:"",icp:"",beian:"",author:"",description:""});a((()=>p.setting),(e=>{null!=e&&(m.value=p.setting)}));const c=t(null),v=u({title:[{required:!0,message:"网站标题不能为空",trigger:"blur"}],sub_title:[{required:!0,message:"副标题不能为空",trigger:"blur"}]}),f=()=>{var e;null==(e=c.value)||e.validate((e=>{if(!e)return!1;l("update:setting",m.value),l("handleSubmit")}))};return(e,l)=>{const t=s("el-input"),a=s("el-form-item"),u=s("el-button"),p=s("el-form"),b=s("el-card");return d(),n(b,{shadow:"never"},{default:o((()=>[r(p,{model:m.value,ref_key:"formRef",ref:c,"label-position":"right","label-width":"100px",rules:v},{default:o((()=>[r(a,{label:"网站标题：",prop:"title"},{default:o((()=>[r(t,{class:"form-input",modelValue:m.value.title,"onUpdate:modelValue":l[0]||(l[0]=e=>m.value.title=e),placeholder:"请输入网站标题"},null,8,["modelValue"])])),_:1}),r(a,{label:"副标题：",prop:"sub_title"},{default:o((()=>[r(t,{class:"form-input",modelValue:m.value.sub_title,"onUpdate:modelValue":l[1]||(l[1]=e=>m.value.sub_title=e),placeholder:"请输入副标题"},null,8,["modelValue"])])),_:1}),r(a,{label:"关键字：",prop:"keywords"},{default:o((()=>[r(t,{class:"form-input",modelValue:m.value.keywords,"onUpdate:modelValue":l[2]||(l[2]=e=>m.value.keywords=e)},null,8,["modelValue"])])),_:1}),r(a,{label:"icp备案：",prop:"icp"},{default:o((()=>[r(t,{class:"form-input",modelValue:m.value.icp,"onUpdate:modelValue":l[3]||(l[3]=e=>m.value.icp=e)},null,8,["modelValue"])])),_:1}),r(a,{label:"公安备案：",prop:"beian"},{default:o((()=>[r(t,{class:"form-input",modelValue:m.value.beian,"onUpdate:modelValue":l[4]||(l[4]=e=>m.value.beian=e)},null,8,["modelValue"])])),_:1}),r(a,{label:"网站作者：",prop:"author"},{default:o((()=>[r(t,{class:"form-input",modelValue:m.value.author,"onUpdate:modelValue":l[5]||(l[5]=e=>m.value.author=e)},null,8,["modelValue"])])),_:1}),r(a,{label:"描述：",prop:"description"},{default:o((()=>[r(t,{class:"form-input",modelValue:m.value.description,"onUpdate:modelValue":l[6]||(l[6]=e=>m.value.description=e),placeholder:"输入描述",type:"textarea"},null,8,["modelValue"])])),_:1}),r(a,null,{default:o((()=>[r(u,{type:"primary",onClick:f},{default:o((()=>[i("保存")])),_:1})])),_:1})])),_:1},8,["model","rules"])])),_:1})}}}),V=l({name:"Guestbook"}),h=p(l({...V,props:{setting:{type:Object,required:!0}},emits:["update:setting","handleSubmit"],setup(e,{emit:l}){const p=e,m=t({content:"",can_comment:!0});a((()=>p.setting),(e=>{null!=e&&(m.value=p.setting)}));const c=t(null),v=u({content:[{required:!0,message:"内容不能为空",trigger:"blur"}]}),f=()=>{var e;null==(e=c.value)||e.validate((e=>{if(!e)return!1;l("update:setting",m.value),l("handleSubmit")}))};return(e,l)=>{const t=s("el-form-item"),a=s("el-switch"),u=s("el-button"),p=s("el-form"),_=s("el-card");return d(),n(_,{shadow:"never",class:"card"},{default:o((()=>[r(p,{model:m.value,ref_key:"formRef",ref:c,"label-position":"right","label-width":"120px",rules:v},{default:o((()=>[r(t,{label:"内容：",prop:"title"},{default:o((()=>[r(b,{content:m.value.content,"onUpdate:content":l[0]||(l[0]=e=>m.value.content=e)},null,8,["content"])])),_:1}),r(t,{label:"是否开启评论：",prop:"can_comment"},{default:o((()=>[r(a,{modelValue:m.value.can_comment,"onUpdate:modelValue":l[1]||(l[1]=e=>m.value.can_comment=e)},null,8,["modelValue"])])),_:1}),r(t,null,{default:o((()=>[r(u,{type:"primary",onClick:f},{default:o((()=>[i("保存")])),_:1})])),_:1})])),_:1},8,["model","rules"])])),_:1})}}}),[["__scopeId","data-v-b2593f18"]]),y={class:"app-container"},k=l({__name:"index",setup(l){const a=t("site"),u=t(),i=()=>{var l;(l=a.value,e({url:"/setting/"+l,method:"get"})).then((e=>{e.data&&(u.value=e.data)}))};m((()=>{i()}));const p=(e,l)=>{a.value=void 0===e.paneName?"":e.paneName.toString(),i()},b=()=>{var l,t;(l=a.value,t=u.value,e({url:`/setting/${l}/update`,method:"post",data:t})).then((()=>{f.success("更新成功")}))};return(e,l)=>{const t=s("el-tab-pane"),i=s("el-tabs"),m=s("el-card");return d(),c("div",y,[r(m,{shadow:"never"},{default:o((()=>[r(i,{modelValue:a.value,"onUpdate:modelValue":l[2]||(l[2]=e=>a.value=e),class:"setting-tabs",onTabClick:p},{default:o((()=>[r(t,{label:"站点配置",name:"site"},{default:o((()=>["site"===a.value?(d(),n(g,{key:0,setting:u.value,"onUpdate:setting":l[0]||(l[0]=e=>u.value=e),onHandleSubmit:b},null,8,["setting"])):v("",!0)])),_:1}),r(t,{label:"留言文本",name:"guestbook"},{default:o((()=>["guestbook"===a.value?(d(),n(h,{key:0,setting:u.value,"onUpdate:setting":l[1]||(l[1]=e=>u.value=e),onHandleSubmit:b},null,8,["setting"])):v("",!0)])),_:1})])),_:1},8,["modelValue"])])),_:1})])}}});export{k as default};
