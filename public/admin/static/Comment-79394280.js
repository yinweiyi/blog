import{a7 as e,b as a,h as t,F as n,p as l,f as o,o as r,z as s,t as i,A as m,i as c,w as u,B as d,_ as p,a as v,n as g,l as h,E as y}from"./index-aa7cad08.js";import{u as f}from"./usePagination-e9891ce3.js";const C={class:"app-container"},_=["id"],b={class:"comment"},k={class:"comment-author vcard"},z=["src"],S={class:"datetime"},P={class:"reply"},R={key:0,class:"children"},j=a({name:"CommentsList"}),q=p(a({...j,props:{comments:{type:Object,required:!0}},emits:["handleReply"],setup(e,{emit:a}){const p=e,v=e=>{a("handleReply",e)};return(e,a)=>{const g=o("el-button"),h=o("CommentList",!0);return r(),t("div",C,[(r(!0),t(n,null,l(p.comments,(e=>(r(),t("div",{class:"comments",id:`comment-${e.id}`},[s("div",b,[s("div",k,[s("img",{src:e.avatar,alt:"用户评论头像",class:"img-circle"},null,8,z),s("strong",null,i(e.nickname),1),m("： "),s("span",S,[m("发表于 "+i(e.created_at)+" ",1),s("span",P,[c(g,{link:"",onClick:a=>v(e),"aria-label":`回复给${e.nickname}`},{default:u((()=>[m("[回复]")])),_:2},1032,["onClick","aria-label"])])])]),s("p",null,i(e.content),1)]),e.children?(r(),t("div",R,[c(h,{comments:e.children,onHandleReply:v},null,8,["comments"])])):d("",!0)],8,_)))),256))])}}}),[["__scopeId","data-v-75db62c2"]]),w={class:"app-container",ref:"appContainer"},x={key:0,class:"comment-reply-user"},V={class:"form-comment"},H=a({name:"Comment"}),I=p(a({...H,props:{id:{type:Number,required:!0},type:{type:String,required:!0}},setup(a){const n=a,l=v({id:n.id,type:n.type,page:1}),p=v({title:"",list:[],total:0}),C=v({parent_id:0,comment:""}),_=v(),b=v({id:0,content:"",avatar:"",nickname:"",email:"",created_at:"",children:[]}),k=e=>{var a;b.value=e,C.value.parent_id=e.id,null==(a=document.querySelector(".app-main"))||a.scrollTo(0,_.value.offsetTop)},z=()=>{var a;0!==C.value.parent_id&&""!==C.value.comment?(a=C.value,e({url:"/comment/reply",method:"post",data:a})).then((()=>{y.success("回复成功"),S()})):y.error("回复内容不能为空")},S=()=>{l.value.page=P.currentPage,function(a){return e({url:"/comment/list",method:"get",params:a})}(l.value).then((e=>{p.value=e.data,P.total=e.data.total}))},{paginationData:P,handleCurrentChange:R,handleSizeChange:j}=f();return g([()=>P.currentPage,()=>P.pageSize],S,{immediate:!0}),(e,a)=>{const n=o("el-pagination"),l=o("el-input"),v=o("el-form-item"),g=o("el-button"),y=o("el-form"),f=o("el-card");return r(),t("div",w,[c(f,{shadow:"never"},{default:u((()=>[s("h3",null,i(p.value.title)+" : 目前有 "+i(p.value.total)+" 条评论",1),c(q,{comments:p.value.list,onHandleReply:k},null,8,["comments"]),c(n,{background:"",layout:h(P).layout,"page-sizes":h(P).pageSizes,total:h(P).total,"page-size":h(P).pageSize,currentPage:h(P).currentPage,onSizeChange:h(j),onCurrentChange:h(R)},null,8,["layout","page-sizes","total","page-size","currentPage","onSizeChange","onCurrentChange"]),s("div",{class:"comment-reply-container",ref_key:"replyContainer",ref:_},[b.value.id>0?(r(),t("div",x," 回复："+i(b.value.nickname),1)):d("",!0),s("div",V,[c(y,{model:C.value,ref:"formRef","label-position":"right"},{default:u((()=>[c(v,null,{default:u((()=>[c(l,{type:"textarea",rows:"5",modelValue:C.value.comment,"onUpdate:modelValue":a[0]||(a[0]=e=>C.value.comment=e)},null,8,["modelValue"])])),_:1}),c(v,null,{default:u((()=>[c(g,{disabled:0===C.value.parent_id||""===C.value.comment,onClick:z},{default:u((()=>[m("提交")])),_:1},8,["disabled"])])),_:1})])),_:1},8,["model"])])],512)])),_:1})],512)}}}),[["__scopeId","data-v-b308d394"]]);export{I as C};
