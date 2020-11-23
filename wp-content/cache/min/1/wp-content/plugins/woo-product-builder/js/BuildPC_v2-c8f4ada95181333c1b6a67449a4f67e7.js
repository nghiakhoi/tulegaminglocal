"use strict";class BuildPC{constructor(build_id){this.select_config={};this.build_id=build_id}
selectItem(category_info,item_info,display_fn){if(Array.isArray(this.select_config))
this.select_config={};this.addCategory(category_info);if(this.getItemIndexInCategory(category_info.id,item_info.id)==-1){this.select_config[category_info.id].items.push(item_info);if(typeof display_fn==='function')
display_fn()}}
updateItem(category_id,item_id,update_key,new_value){const item_index=this.getItemIndexInCategory(category_id,item_id);if(item_index>-1){this.select_config[category_id].items[item_index][update_key]=new_value}}
removeItem(category_id,item_id,display_fn){let item_index=this.getItemIndexInCategory(category_id,item_id);if(item_index>-1){this.select_config[category_id].items.splice(item_index,1);if(this.select_config[category_id].items.length==0){this.emptyCategory(category_id)}
if(typeof display_fn==='function')
display_fn(category_id,item_id)}}
getConfig(){return this.select_config}
getBuildId(){return this.build_id}
setConfig(config){this.select_config=Object.assign({},config)}
emptyConfig(){this.select_config={}}
isItemInCategory(category_id,item_id){return(this.getItemIndexInCategory(category_id,item_id)>-1)}
getItemIndexInCategory(category_id,item_id){let item_index=-1;if(this.select_config.hasOwnProperty(category_id)){this.select_config[category_id].items.forEach(function(item,index){if(item.id==item_id){item_index=index}})}
return item_index}
emptyCategory(category_id){delete this.select_config[category_id]}
addCategory(category_info){if(!this.select_config.hasOwnProperty(category_info.id)){this.select_config[category_info.id]={info:category_info,items:[],}}}}