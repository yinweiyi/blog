import{A as a}from"./Administrator-10a57113.js";import{b as s,a as t,m as r,h as i,i as o,E as n,o as d}from"./index-f7355e81.js";import{s as m}from"./index-14e54555.js";const e={class:"app-container"},p=s({name:"AdministratorAdd"}),u=s({...p,setup(s){const p=t({id:0,name:"",account:"",password:"",password_confirmation:"",status:!0}),u=r(),c=()=>{m(p.value).then((()=>{n.success("添加成功"),u.push("/system/administrators")}))};return(s,t)=>(d(),i("div",e,[o(a,{administrator:p.value,"onUpdate:administrator":t[0]||(t[0]=a=>p.value=a),type:"add",onHandleSubmit:c},null,8,["administrator"])]))}});export{u as default};
