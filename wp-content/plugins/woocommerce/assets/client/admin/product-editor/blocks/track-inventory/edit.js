"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.Edit=void 0;const block_editor_1=require("@wordpress/block-editor"),compose_1=require("@wordpress/compose"),core_data_1=require("@wordpress/core-data"),element_1=require("@wordpress/element"),i18n_1=require("@wordpress/i18n"),components_1=require("@wordpress/components"),use_validation_1=require("../../hooks/use-validation");function Edit({}){const e=(0,block_editor_1.useBlockProps)({className:"wp-block-woocommerce-product-track-inventory-fields"}),[o,t]=(0,core_data_1.useEntityProp)("postType","product","manage_stock"),[n,r]=(0,core_data_1.useEntityProp)("postType","product","stock_quantity"),c=(0,compose_1.useInstanceId)(components_1.BaseControl),s=(0,use_validation_1.useValidation)("product/stock_quantity",(function(){return!o||Boolean(n&&n>=0)}));return(0,element_1.useEffect)((()=>{o&&null===n&&r(1)}),[o,n]),(0,element_1.createElement)("div",{...e},(0,element_1.createElement)(components_1.ToggleControl,{label:(0,i18n_1.__)("Track stock quantity for this product","woocommerce"),checked:o,onChange:t}),o&&(0,element_1.createElement)("div",{className:"wp-block-columns"},(0,element_1.createElement)("div",{className:"wp-block-column"},(0,element_1.createElement)(components_1.BaseControl,{id:c,className:s?void 0:"has-error",help:s?void 0:(0,i18n_1.__)("Stock quantity must be a positive number.","woocommerce")},(0,element_1.createElement)(components_1.__experimentalInputControl,{name:"stock_quantity",label:(0,i18n_1.__)("Available quantity","woocommerce"),value:n,onChange:r,type:"number",min:0}))),(0,element_1.createElement)("div",{className:"wp-block-column"})))}exports.Edit=Edit;