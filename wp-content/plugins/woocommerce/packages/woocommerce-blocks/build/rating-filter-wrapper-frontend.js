(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[83,75],{109:function(e){e.exports=JSON.parse('{"name":"woocommerce/rating-filter","version":"1.0.0","title":"Filter by Rating Controls","description":"Enable customers to filter the product grid by rating.","category":"woocommerce","keywords":["WooCommerce"],"supports":{"html":false,"multiple":false,"color":true,"inserter":false,"lock":false},"attributes":{"className":{"type":"string","default":""},"showCounts":{"type":"boolean","default":true},"displayStyle":{"type":"string","default":"list"},"showFilterButton":{"type":"boolean","default":false},"selectType":{"type":"string","default":"multiple"},"isPreview":{"type":"boolean","default":false}},"textdomain":"woocommerce","apiVersion":2,"$schema":"https://schemas.wp.org/trunk/block.json"}')},116:function(e,t,n){"use strict";var c=n(0),r=n(1),o=n(6),a=n.n(o),l=n(24);n(193),t.a=e=>{let{className:t,label:
/* translators: Reset button text for filters. */
n=Object(r.__)("Reset","woocommerce"),onClick:o,screenReaderLabel:s=Object(r.__)("Reset filter","woocommerce")}=e;return Object(c.createElement)("button",{className:a()("wc-block-components-filter-reset-button",t),onClick:o},Object(c.createElement)(l.a,{label:n,screenReaderLabel:s}))}},117:function(e,t,n){"use strict";var c=n(0),r=n(1),o=n(6),a=n.n(o),l=n(24);n(194),t.a=e=>{let{className:t,isLoading:n,disabled:o,label:
/* translators: Submit button text for filters. */
s=Object(r.__)("Apply","woocommerce"),onClick:i,screenReaderLabel:u=Object(r.__)("Apply filter","woocommerce")}=e;return Object(c.createElement)("button",{type:"submit",className:a()("wp-block-button__link","wc-block-filter-submit-button","wc-block-components-filter-submit-button",{"is-loading":n},t),disabled:o,onClick:i},Object(c.createElement)(l.a,{label:s,screenReaderLabel:u}))}},121:function(e,t,n){"use strict";var c=n(11),r=n.n(c),o=n(0),a=n(209),l=n(6),s=n.n(l);n(195),t.a=e=>{let{className:t,style:n,suggestions:c,multiple:l=!0,saveTransform:i=(e=>e.trim().replace(/\s/g,"-")),messages:u={},validateInput:b=(e=>c.includes(e)),label:d="",...f}=e;return Object(o.createElement)("div",{className:s()("wc-blocks-components-form-token-field-wrapper",t,{"single-selection":!l}),style:n},Object(o.createElement)(a.a,r()({label:d,__experimentalExpandOnFocus:!0,__experimentalShowHowTo:!1,__experimentalValidateInput:b,saveTransform:i,maxLength:l?void 0:1,suggestions:c,messages:u},f)))}},122:function(e,t,n){"use strict";var c=n(0),r=n(1),o=n(6),a=n.n(o),l=n(7);n(196),t.a=e=>{let{className:t,onChange:n,options:o=[],checked:s=[],isLoading:i=!1,isDisabled:u=!1,limit:b=10}=e;const[d,f]=Object(c.useState)(!1),g=Object(c.useMemo)(()=>[...Array(5)].map((e,t)=>Object(c.createElement)("li",{key:t,style:{width:Math.floor(75*Math.random())+25+"%"}})),[]),O=Object(c.useMemo)(()=>{const e=o.length-b;return!d&&Object(c.createElement)("li",{key:"show-more",className:"show-more"},Object(c.createElement)("button",{onClick:()=>{f(!0)},"aria-expanded":!1,"aria-label":Object(r.sprintf)(
/* translators: %s is referring the remaining count of options */
Object(r._n)("Show %s more option","Show %s more options",e,"woocommerce"),e)},Object(r.sprintf)(
/* translators: %s number of options to reveal. */
Object(r._n)("Show %s more","Show %s more",e,"woocommerce"),e)))},[o,b,d]),m=Object(c.useMemo)(()=>d&&Object(c.createElement)("li",{key:"show-less",className:"show-less"},Object(c.createElement)("button",{onClick:()=>{f(!1)},"aria-expanded":!0,"aria-label":Object(r.__)("Show less options","woocommerce")},Object(r.__)("Show less","woocommerce"))),[d]),j=Object(c.useMemo)(()=>{const e=o.length>b+5;return Object(c.createElement)(c.Fragment,null,o.map((t,r)=>Object(c.createElement)(c.Fragment,{key:t.value},Object(c.createElement)("li",e&&!d&&r>=b&&{hidden:!0},Object(c.createElement)(l.CheckboxControl,{id:t.value,className:"wc-block-checkbox-list__checkbox",label:t.label,checked:s.includes(t.value),onChange:()=>{n(t.value)},disabled:u})),e&&r===b-1&&O)),e&&m)},[o,n,s,d,b,m,O,u]),p=a()("wc-block-checkbox-list","wc-block-components-checkbox-list",{"is-loading":i},t);return Object(c.createElement)("ul",{className:p},i?g:j)}},129:function(e,t,n){"use strict";var c=n(0),r=n(1),o=n(27),a=n(84),l=n(247),s=n(6),i=n.n(s),u=e=>{let{className:t,rating:n,ratedProductsCount:o}=e;const a=i()("wc-block-components-product-rating",t),l={width:n/5*100+"%"},s=Object(r.sprintf)(
/* translators: %f is referring to the average rating value */
Object(r.__)("Rated %f out of 5","woocommerce"),n),u={__html:Object(r.sprintf)(
/* translators: %s is the rating value wrapped in HTML strong tags. */
Object(r.__)("Rated %s out of 5","woocommerce"),Object(r.sprintf)('<strong class="rating">%f</strong>',n))};return Object(c.createElement)("div",{className:a},Object(c.createElement)("div",{className:"wc-block-components-product-rating__stars",role:"img","aria-label":s},Object(c.createElement)("span",{style:l,dangerouslySetInnerHTML:u})),null!==o?Object(c.createElement)("span",{className:"wc-block-components-product-rating-count"},"(",o,")"):null)},b=n(44),d=n(67),f=n(62),g=n(246),O=n(2),m=n(96),j=n(25),p=n(18),y=n.n(p),v=n(122),h=n(117),w=n(116),_=n(121),k=n(19),E=n(97);const S=[{label:Object(c.createElement)(u,{className:"",key:5,rating:5,ratedProductsCount:5}),value:"5"},{label:Object(c.createElement)(u,{className:"",key:4,rating:4,ratedProductsCount:4}),value:"4"},{label:Object(c.createElement)(u,{className:"",key:3,rating:3,ratedProductsCount:3}),value:"3"},{label:Object(c.createElement)(u,{className:"",key:2,rating:2,ratedProductsCount:2}),value:"2"},{label:Object(c.createElement)(u,{className:"",key:1,rating:1,ratedProductsCount:1}),value:"1"}];n(202);var C=n(81),N=n(61);const R=e=>Object(r.sprintf)(
/* translators: %s is referring to the average rating value */
Object(r.__)("Rated %s out of 5 filter added.","woocommerce"),e),x=e=>Object(r.sprintf)(
/* translators: %s is referring to the average rating value */
Object(r.__)("Rated %s out of 5 filter added.","woocommerce"),e);t.a=e=>{let{attributes:t,isEditor:n,noRatingsNotice:s=null}=e;const p=Object(N.b)(),T=Object(O.getSettingWithCoercion)("is_rendering_php_template",!1,m.a),[F,L]=Object(c.useState)(!1),[A]=Object(f.a)(),{results:P,isLoading:q}=Object(g.a)({queryRating:!0,queryState:A,isEditor:n}),[Q,M]=Object(c.useState)(t.isPreview?S:[]),Y=!t.isPreview&&q&&0===Q.length,B=!t.isPreview&&q,W=Object(c.useMemo)(()=>Object(C.c)("rating_filter"),[]),[z,D]=Object(c.useState)(W),[I,V]=Object(f.b)("rating",W),[K,$]=Object(c.useState)(Object(C.b)()),[H,J]=Object(c.useState)(!1),U="single"!==t.selectType,Z=U?!Y&&z.length<Q.length:!Y&&0===z.length,G=Object(c.useCallback)(e=>{n||(e&&!T&&V(e),(e=>{if(!window)return;if(0===e.length){const e=Object(k.removeQueryArgs)(window.location.href,"rating_filter");return void(e!==Object(E.e)(window.location.href)&&Object(E.c)(e))}const t=Object(k.addQueryArgs)(window.location.href,{rating_filter:e.join(",")});t!==Object(E.e)(window.location.href)&&Object(E.c)(t)})(e))},[n,V,T]);Object(c.useEffect)(()=>{t.showFilterButton||G(z)},[t.showFilterButton,z,G]);const X=Object(c.useMemo)(()=>I,[I]),ee=Object(b.a)(X),te=Object(d.a)(ee);Object(c.useEffect)(()=>{y()(te,ee)||y()(z,ee)||D(ee)},[z,ee,te]),Object(c.useEffect)(()=>{F||(V(W),L(!0))},[V,F,L,W]),Object(c.useEffect)(()=>{if(q||t.isPreview)return;const e=!q&&Object(j.b)(P,"rating_counts")&&Array.isArray(P.rating_counts)?[...P.rating_counts].reverse():[];if(n&&0===e.length)return M(S),void J(!0);const r=e.filter(e=>Object(j.a)(e)&&Object.keys(e).length>0).map(e=>{var n;return{label:Object(c.createElement)(u,{key:null==e?void 0:e.rating,rating:null==e?void 0:e.rating,ratedProductsCount:t.showCounts?null==e?void 0:e.count:null}),value:null==e||null===(n=e.rating)||void 0===n?void 0:n.toString()}});M(r),$(Object(C.b)())},[t.showCounts,t.isPreview,P,q,I,n]);const ne=Object(c.useCallback)(e=>{const t=z.includes(e);if(!U){const n=t?[]:[e];return Object(o.speak)(t?x(e):R(e)),void D(n)}if(t){const t=z.filter(t=>t!==e);return Object(o.speak)(x(e)),void D(t)}const n=[...z,e].sort((e,t)=>Number(t)-Number(e));Object(o.speak)(R(e)),D(n)},[z,U]);return(q||0!==Q.length)&&Object(O.getSettingWithCoercion)("has_filterable_products",!1,m.a)?(p(!0),Object(c.createElement)(c.Fragment,null,H&&s,Object(c.createElement)("div",{className:i()("wc-block-rating-filter","style-"+t.displayStyle,{"is-loading":Y})},"dropdown"===t.displayStyle?Object(c.createElement)(c.Fragment,null,Object(c.createElement)(_.a,{key:K,className:i()({"single-selection":!U,"is-loading":Y}),style:{borderStyle:"none"},suggestions:Q.filter(e=>!z.includes(e.value)).map(e=>e.value),disabled:Y,placeholder:Object(r.__)("Select Rating","woocommerce"),onChange:e=>{!U&&e.length>1&&(e=[e[e.length-1]]);const t=[e=e.map(e=>{const t=Q.find(t=>t.value===e);return t?t.value:e}),z].reduce((e,t)=>e.filter(e=>!t.includes(e)));if(1===t.length)return ne(t[0]);const n=[z,e].reduce((e,t)=>e.filter(e=>!t.includes(e)));1===n.length&&ne(n[0])},value:z,displayTransform:e=>{const t={value:e,label:Object(c.createElement)(u,{key:Number(e),rating:Number(e),ratedProductsCount:0})},n=Q.find(t=>t.value===e)||t,{label:r,value:o}=n;return Object.assign({},r,{toLocaleLowerCase:()=>o,substring:(e,t)=>0===e&&1===t?r:""})},saveTransform:C.a,messages:{added:Object(r.__)("Rating filter added.","woocommerce"),removed:Object(r.__)("Rating filter removed.","woocommerce"),remove:Object(r.__)("Remove rating filter.","woocommerce"),__experimentalInvalid:Object(r.__)("Invalid rating filter.","woocommerce")}}),Z&&Object(c.createElement)(a.a,{icon:l.a,size:30})):Object(c.createElement)(v.a,{className:"wc-block-rating-filter-list",options:Q,checked:z,onChange:e=>{ne(e.toString())},isLoading:Y,isDisabled:B})),Object(c.createElement)("div",{className:"wc-block-rating-filter__actions"},(z.length>0||n)&&!Y&&Object(c.createElement)(w.a,{onClick:()=>{D([]),V([]),G([])},screenReaderLabel:Object(r.__)("Reset rating filter","woocommerce")}),t.showFilterButton&&Object(c.createElement)(h.a,{className:"wc-block-rating-filter__button",isLoading:Y,disabled:Y||B,onClick:()=>G(z)})))):(p(!1),null)}},193:function(e,t){},194:function(e,t){},195:function(e,t){},196:function(e,t){},197:function(e,t,n){"use strict";n.d(t,"a",(function(){return c}));const c=e=>null==e||"object"==typeof e&&0===Object.keys(e).length||"string"==typeof e&&0===e.trim().length},202:function(e,t){},24:function(e,t,n){"use strict";var c=n(0),r=n(6),o=n.n(r);t.a=e=>{let t,{label:n,screenReaderLabel:r,wrapperElement:a,wrapperProps:l={}}=e;const s=null!=n,i=null!=r;return!s&&i?(t=a||"span",l={...l,className:o()(l.className,"screen-reader-text")},Object(c.createElement)(t,l,r)):(t=a||c.Fragment,s&&i&&n!==r?Object(c.createElement)(t,l,Object(c.createElement)("span",{"aria-hidden":"true"},n),Object(c.createElement)("span",{className:"screen-reader-text"},r)):Object(c.createElement)(t,l,n))}},246:function(e,t,n){"use strict";n.d(t,"a",(function(){return d}));var c=n(0),r=n(125),o=n(25),a=n(197),l=n(83),s=n(44),i=n(62),u=n(94),b=n(33);const d=e=>{let{queryAttribute:t,queryPrices:n,queryStock:d,queryRating:f,queryState:g,productIds:O,isEditor:m=!1}=e,j=Object(b.a)();j+="-collection-data";const[p]=Object(i.a)(j),[y,v]=Object(i.b)("calculate_attribute_counts",[],j),[h,w]=Object(i.b)("calculate_price_range",null,j),[_,k]=Object(i.b)("calculate_stock_status_counts",null,j),[E,S]=Object(i.b)("calculate_rating_counts",null,j),C=Object(s.a)(t||{}),N=Object(s.a)(n),R=Object(s.a)(d),x=Object(s.a)(f);Object(c.useEffect)(()=>{"object"==typeof C&&Object.keys(C).length&&(y.find(e=>Object(o.b)(C,"taxonomy")&&e.taxonomy===C.taxonomy)||v([...y,C]))},[C,y,v]),Object(c.useEffect)(()=>{h!==N&&void 0!==N&&w(N)},[N,w,h]),Object(c.useEffect)(()=>{_!==R&&void 0!==R&&k(R)},[R,k,_]),Object(c.useEffect)(()=>{E!==x&&void 0!==x&&S(x)},[x,S,E]);const[T,F]=Object(c.useState)(m),[L]=Object(r.a)(T,200);T||F(!0);const A=Object(c.useMemo)(()=>(e=>{const t=e;return Array.isArray(e.calculate_attribute_counts)&&(t.calculate_attribute_counts=Object(l.a)(e.calculate_attribute_counts.map(e=>{let{taxonomy:t,queryType:n}=e;return{taxonomy:t,query_type:n}})).asc(["taxonomy","query_type"])),t})(p),[p]);return Object(u.a)({namespace:"/wc/store/v1",resourceName:"products/collection-data",query:{...g,page:void 0,per_page:void 0,orderby:void 0,order:void 0,...!Object(a.a)(O)&&{include:O},...A},shouldSelect:L})}},25:function(e,t,n){"use strict";n.d(t,"a",(function(){return c})),n.d(t,"b",(function(){return r}));const c=e=>!(e=>null===e)(e)&&e instanceof Object&&e.constructor===Object;function r(e,t){return c(e)&&t in e}},264:function(e,t,n){"use strict";n.d(t,"a",(function(){return d}));var c=n(6),r=n.n(c),o=n(25),a=n(35);const l=e=>Object(a.a)(e)?JSON.parse(e)||{}:Object(o.a)(e)?e:{};var s=n(263),i=n(99);function u(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};const t={};return Object(i.getCSSRules)(e,{selector:""}).forEach(e=>{t[e.key]=e.value}),t}function b(e,t){return e&&t?`has-${Object(s.a)(t)}-${e}`:""}const d=e=>{const t=Object(o.a)(e)?e:{style:{}},n=l(t.style),c=function(e){var t,n,c,a,l,s,i;const{backgroundColor:d,textColor:f,gradient:g,style:O}=e,m=b("background-color",d),j=b("color",f),p=function(e){if(e)return`has-${e}-gradient-background`}(g),y=p||(null==O||null===(t=O.color)||void 0===t?void 0:t.gradient);return{className:r()(j,p,{[m]:!y&&!!m,"has-text-color":f||(null==O||null===(n=O.color)||void 0===n?void 0:n.text),"has-background":d||(null==O||null===(c=O.color)||void 0===c?void 0:c.background)||g||(null==O||null===(a=O.color)||void 0===a?void 0:a.gradient),"has-link-color":Object(o.a)(null==O||null===(l=O.elements)||void 0===l?void 0:l.link)?null==O||null===(s=O.elements)||void 0===s||null===(i=s.link)||void 0===i?void 0:i.color:void 0})||void 0,style:u({color:(null==O?void 0:O.color)||{}})}}({...t,style:n}),s=function(e){var t;const n=(null===(t=e.style)||void 0===t?void 0:t.border)||{};return{className:function(e){var t;const{borderColor:n,style:c}=e,o=n?b("border-color",n):"";return r()({"has-border-color":n||(null==c||null===(t=c.border)||void 0===t?void 0:t.color),borderColorClass:o})}(e)||void 0,style:u({border:n})}}({...t,style:n}),i=function(e){const{style:t}=e;return{className:void 0,style:u({spacing:(null==t?void 0:t.spacing)||{}})}}({...t,style:n}),d=(e=>{const t=l(e.style),n=Object(o.a)(t.typography)?t.typography:{},c=Object(a.a)(n.fontFamily)?n.fontFamily:"";return{className:e.fontFamily?`has-${e.fontFamily}-font-family`:c,style:{fontSize:e.fontSize?`var(--wp--preset--font-size--${e.fontSize})`:n.fontSize,fontStyle:n.fontStyle,fontWeight:n.fontWeight,letterSpacing:n.letterSpacing,lineHeight:n.lineHeight,textDecoration:n.textDecoration,textTransform:n.textTransform}}})(t);return{className:r()(d.className,c.className,s.className,i.className),style:{...d.style,...c.style,...s.style,...i.style}}}},33:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var c=n(0);const r=Object(c.createContext)("page"),o=()=>Object(c.useContext)(r);r.Provider},35:function(e,t,n){"use strict";n.d(t,"a",(function(){return c}));const c=e=>"string"==typeof e},44:function(e,t,n){"use strict";n.d(t,"a",(function(){return a}));var c=n(0),r=n(18),o=n.n(r);function a(e){const t=Object(c.useRef)(e);return o()(e,t.current)||(t.current=e),t.current}},472:function(e,t,n){"use strict";n.r(t);var c=n(0),r=n(6),o=n.n(r),a=n(264),l=n(35),s=n(129),i=n(81);t.default=e=>{const t=Object(a.a)(e),n=Object(i.d)(e);return Object(c.createElement)("div",{className:o()(Object(l.a)(e.className)?e.className:"",t.className),style:t.style},Object(c.createElement)(s.a,{isEditor:!1,attributes:n}))}},62:function(e,t,n){"use strict";n.d(t,"a",(function(){return b})),n.d(t,"b",(function(){return d})),n.d(t,"c",(function(){return f}));var c=n(3),r=n(5),o=n(0),a=n(18),l=n.n(a),s=n(44),i=n(67),u=n(33);const b=e=>{const t=Object(u.a)();e=e||t;const n=Object(r.useSelect)(t=>t(c.QUERY_STATE_STORE_KEY).getValueForQueryContext(e,void 0),[e]),{setValueForQueryContext:a}=Object(r.useDispatch)(c.QUERY_STATE_STORE_KEY);return[n,Object(o.useCallback)(t=>{a(e,t)},[e,a])]},d=(e,t,n)=>{const a=Object(u.a)();n=n||a;const l=Object(r.useSelect)(r=>r(c.QUERY_STATE_STORE_KEY).getValueForQueryKey(n,e,t),[n,e]),{setQueryValue:s}=Object(r.useDispatch)(c.QUERY_STATE_STORE_KEY);return[l,Object(o.useCallback)(t=>{s(n,e,t)},[n,e,s])]},f=(e,t)=>{const n=Object(u.a)();t=t||n;const[c,r]=b(t),a=Object(s.a)(c),d=Object(s.a)(e),f=Object(i.a)(d),g=Object(o.useRef)(!1);return Object(o.useEffect)(()=>{l()(f,d)||(r(Object.assign({},a,d)),g.current=!0)},[a,d,f,r]),g.current?[c,r]:[e,r]}},67:function(e,t,n){"use strict";n.d(t,"a",(function(){return r}));var c=n(0);function r(e,t){const n=Object(c.useRef)();return Object(c.useEffect)(()=>{n.current===e||t&&!t(e,n.current)||(n.current=e)},[e,t]),n.current}},81:function(e,t,n){"use strict";n.d(t,"c",(function(){return a})),n.d(t,"b",(function(){return l})),n.d(t,"a",(function(){return s})),n.d(t,"d",(function(){return i}));var c=n(35),r=n(97),o=n(109);const a=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"filter_rating";const t=Object(r.d)(e);if(!t)return[];const n=Object(c.a)(t)?t.split(","):t;return n};function l(){return Math.floor(Math.random()*Date.now())}const s=e=>e.trim().replace(/\s/g,"-").replace(/_/g,"-").replace(/-+/g,"-").replace(/[^a-zA-Z0-9-]/g,""),i=e=>({showFilterButton:"true"===(null==e?void 0:e.showFilterButton),showCounts:"false"!==(null==e?void 0:e.showCounts),isPreview:!1,displayStyle:Object(c.a)(null==e?void 0:e.displayStyle)&&e.displayStyle||o.attributes.displayStyle.default,selectType:Object(c.a)(null==e?void 0:e.selectType)&&e.selectType||o.attributes.selectType.default})},94:function(e,t,n){"use strict";n.d(t,"a",(function(){return l}));var c=n(3),r=n(5),o=n(0),a=n(44);const l=e=>{const{namespace:t,resourceName:n,resourceValues:l=[],query:s={},shouldSelect:i=!0}=e;if(!t||!n)throw new Error("The options object must have valid values for the namespace and the resource properties.");const u=Object(o.useRef)({results:[],isLoading:!0}),b=Object(a.a)(s),d=Object(a.a)(l),f=(()=>{const[,e]=Object(o.useState)();return Object(o.useCallback)(t=>{e(()=>{throw t})},[])})(),g=Object(r.useSelect)(e=>{if(!i)return null;const r=e(c.COLLECTIONS_STORE_KEY),o=[t,n,b,d],a=r.getCollectionError(...o);if(a){if(!(a instanceof Error))throw new Error("TypeError: `error` object is not an instance of Error constructor");f(a)}return{results:r.getCollection(...o),isLoading:!r.hasFinishedResolution("getCollection",o)}},[t,n,d,b,i]);return null!==g&&(u.current=g),u.current}},96:function(e,t,n){"use strict";n.d(t,"a",(function(){return c}));const c=e=>"boolean"==typeof e},97:function(e,t,n){"use strict";n.d(t,"b",(function(){return l})),n.d(t,"a",(function(){return s})),n.d(t,"d",(function(){return i})),n.d(t,"c",(function(){return u})),n.d(t,"e",(function(){return b}));var c=n(19),r=n(2),o=n(96);const a=Object(r.getSettingWithCoercion)("is_rendering_php_template",!1,o.a),l="query_type_",s="filter_";function i(e){return window?Object(c.getQueryArg)(window.location.href,e):null}function u(e){a?window.location.href=e:window.history.replaceState({},"",e)}const b=e=>{const t=Object(c.getQueryArgs)(e);return Object(c.addQueryArgs)(e,t)}}}]);