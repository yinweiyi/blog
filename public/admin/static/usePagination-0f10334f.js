import{r as e}from"./index-f7355e81.js";const a={total:0,currentPage:1,pageSizes:[10,20,50],pageSize:10,layout:"total, sizes, prev, pager, next, jumper"};function t(t={}){const n=e(Object.assign({...a},t));return{paginationData:n,handleCurrentChange:e=>{n.currentPage=e},handleSizeChange:e=>{n.pageSize=e}}}export{t as u};