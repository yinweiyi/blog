import{u as e,s as a,d as l,a as t}from"./index-8b880efa.js";import{b as o,r,e as n,a as i,h as s,i as u,w as d,f as p,o as g,l as c,A as m,m as f,n as h,W as v,j as b,a8 as _,z as w,a9 as y,aa as C,B as z,E as V,_ as S}from"./index-aa7cad08.js";import{u as x}from"./usePagination-e9891ce3.js";const D={class:"app-container"},k=o({name:"Tag"}),j=o({...k,props:{tag:{type:Object,required:!0},showDialog:{type:Boolean,required:!0,default:!1}},emits:["update:showDialog","update:tag","handleSubmit"],setup(e,{emit:a}){const l=e,t=r({isShowDialog:l.showDialog,loading:!1}),o=n((()=>l.tag)),f=e=>{a("update:showDialog",!1),e()},h=i(null),v=r({name:[{required:!0,message:"标签名不能为空",trigger:"blur"}],slug:[{required:!0,message:"标识不能为空",trigger:"blur"},{min:2,max:20,message:"长度必须在 2 到 20 位之间",trigger:"blur"}]}),b=()=>{var e;null==(e=h.value)||e.validate((e=>{if(!e)return!1;a("update:tag",o.value),a("handleSubmit")}))},_=()=>{a("update:showDialog",!1)};return(e,a)=>{const l=p("el-input"),r=p("el-form-item"),n=p("el-input-number"),i=p("el-form"),w=p("el-button"),y=p("el-card"),C=p("el-dialog");return g(),s("div",D,[u(C,{modelValue:t.isShowDialog,"onUpdate:modelValue":a[4]||(a[4]=e=>t.isShowDialog=e),title:"分类","before-close":f},{default:d((()=>[u(y,{shadow:"never"},{default:d((()=>[u(i,{model:c(o),ref_key:"formRef",ref:h,"label-position":"right","label-width":"100px",rules:v},{default:d((()=>[u(r,{label:"标签名：",prop:"name"},{default:d((()=>[u(l,{class:"form-input",modelValue:c(o).name,"onUpdate:modelValue":a[0]||(a[0]=e=>c(o).name=e),placeholder:"请输入标签名"},null,8,["modelValue"])])),_:1}),u(r,{label:"标识：",prop:"slug"},{default:d((()=>[u(l,{class:"form-input",modelValue:c(o).slug,"onUpdate:modelValue":a[1]||(a[1]=e=>c(o).slug=e),placeholder:"请输入标识"},null,8,["modelValue"])])),_:1}),u(r,{label:"排序：",prop:"order"},{default:d((()=>[u(n,{class:"form-input",modelValue:c(o).order,"onUpdate:modelValue":a[2]||(a[2]=e=>c(o).order=e)},null,8,["modelValue"])])),_:1}),u(r,{label:"描述：",prop:"description"},{default:d((()=>[u(l,{class:"form-input",modelValue:c(o).description,"onUpdate:modelValue":a[3]||(a[3]=e=>c(o).description=e),placeholder:"输入描述",type:"textarea"},null,8,["modelValue"])])),_:1})])),_:1},8,["model","rules"]),u(r,{style:{"padding-left":"100px"}},{default:d((()=>[u(w,{type:"primary",onClick:b},{default:d((()=>[m("保存")])),_:1}),u(w,{style:{"margin-left":"10px"},onClick:_},{default:d((()=>[m("取消")])),_:1})])),_:1})])),_:1})])),_:1},8,["modelValue"])])}}}),U={class:"app-container"},P={class:"toolbar-wrapper"},q={class:"table-wrapper"},O={class:"pager-wrapper"},A=o({name:"Tags"}),B=S(o({...A,setup(o){const r=i(!1),{paginationData:n,handleCurrentChange:S,handleSizeChange:D}=x(),k=i(!1),A=i([]);f();const B={id:0,order:0,name:"",slug:"",description:""},E=i(Object.assign({},B)),T=()=>{E.value.id>0?e(E.value.id,E.value).then((()=>{V.success("更新成功"),k.value=!1,F()})):a(E.value).then((()=>{V.success("添加成功"),k.value=!1,F()}))},F=()=>{r.value=!0,t({page:n.currentPage,pageSize:n.pageSize}).then((e=>{n.total=e.data.total,A.value=e.data.list})).catch((()=>{A.value=[]})).finally((()=>{r.value=!1}))};return h([()=>n.currentPage,()=>n.pageSize],F,{immediate:!0}),(e,a)=>{const t=p("el-button"),o=p("el-table-column"),i=p("el-popconfirm"),f=p("el-table"),h=p("el-pagination"),x=p("el-card"),H=_("loading");return g(),s("div",U,[v((g(),b(x,{shadow:"never"},{default:d((()=>[w("div",P,[w("div",null,[u(t,{type:"primary",icon:c(y),onClick:a[0]||(a[0]=e=>(E.value=Object.assign({},B),void(k.value=!0)))},{default:d((()=>[m("新增标签")])),_:1},8,["icon"])])]),w("div",q,[u(f,{data:A.value,"row-key":"id",border:"","default-expand-all":""},{default:d((()=>[u(o,{prop:"name",label:"标签名",align:"center"}),u(o,{prop:"slug",label:"标识",align:"center"}),u(o,{prop:"order",label:"排序",align:"center",sortable:""}),u(o,{prop:"created_at",label:"创建时间",align:"center"}),u(o,{fixed:"right",label:"操作",width:"240"},{default:d((({row:e})=>[u(t,{type:"primary",text:"",bg:"",size:"small",onClick:a=>(e=>{const{id:a,order:l,name:t,slug:o,description:r}=e;E.value={id:a,order:l,name:t,slug:o,description:r},k.value=!0})(e)},{default:d((()=>[m("编辑")])),_:2},1032,["onClick"]),u(i,{icon:c(C),"icon-color":"#626AEF",title:"真的要删除此条数据吗？",onConfirm:a=>(e=>{l(e.id).then((()=>{V.success("删除成功"),F()}))})(e)},{reference:d((()=>[u(t,{type:"danger",text:"",bg:"",size:"small"},{default:d((()=>[m("删除")])),_:1})])),_:2},1032,["icon","onConfirm"])])),_:1})])),_:1},8,["data"]),k.value?(g(),b(j,{key:0,"show-dialog":k.value,"onUpdate:showDialog":a[1]||(a[1]=e=>k.value=e),tag:E.value,"onUpdate:tag":a[2]||(a[2]=e=>E.value=e),onHandleSubmit:T},null,8,["show-dialog","tag"])):z("",!0)]),w("div",O,[u(h,{background:"",layout:c(n).layout,"page-sizes":c(n).pageSizes,total:c(n).total,"page-size":c(n).pageSize,currentPage:c(n).currentPage,onSizeChange:c(D),onCurrentChange:c(S)},null,8,["layout","page-sizes","total","page-size","currentPage","onSizeChange","onCurrentChange"])])])),_:1})),[[H,r.value]])])}}}),[["__scopeId","data-v-c61a0960"]]);export{B as default};
