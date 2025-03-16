(()=>{let r={artworks:"/admin/admin_includes/artworks_actions/get_artworks.php",register:"/includes/register_handler.php",login:"/includes/login_handler.php"},a={menuToggle:document.getElementById("menu_toggle"),navMenu:document.getElementById("nav_menu"),artworksGrid:document.getElementById("artworksGrid"),loginFormWrapper:document.getElementById("loginFormWrapper"),registerFormWrapper:document.getElementById("registerFormWrapper"),showRegisterFormButton:document.getElementById("showRegisterForm"),showLoginFormButton:document.getElementById("showLoginForm")};async function i(t,e={}){try{var s=await fetch(t,e),o=await s.text();if(s.ok)return JSON.parse(o);throw new Error("HTTP error! status: "+s.status)}catch(e){throw console.error(`Error fetching data from ${t}:`,e),e}}a.navMenu&&Array.from(a.navMenu.querySelectorAll("li")),document.querySelectorAll(".card").forEach(o=>{o.addEventListener("mousemove",e=>{var t=o.getBoundingClientRect(),s=e.clientX-t.left,e=e.clientY-t.top;o.style.setProperty("--x",s+"px"),o.style.setProperty("--y",e+"px")})}),document.addEventListener("DOMContentLoaded",function(){{let{menuToggle:s,navMenu:o}=a;if(s&&o){let t=o.querySelectorAll("a");var e=o.querySelectorAll("form");s.addEventListener("click",()=>{var e=!o.classList.contains("active");o.classList.toggle("active"),s.classList.toggle("open"),e&&t.forEach((e,t)=>{e.style.animation=`fadeInUp 0.5s ease forwards ${.5+.1*t}s`})}),t.forEach(e=>{e.addEventListener("click",()=>{o.classList.remove("active"),s.classList.remove("open")})}),e.forEach(e=>{e.addEventListener("click",e=>{e.stopPropagation()}),e.addEventListener("submit",()=>{o.classList.remove("active"),s.classList.remove("open")})})}else console.error("Menu toggle or navigation menu is not defined.")}{let{loginFormWrapper:e,registerFormWrapper:t,showRegisterFormButton:s,showLoginFormButton:o}=a;e&&t&&s&&o?(s.addEventListener("click",()=>{e.classList.remove("active"),t.classList.add("active")}),o.addEventListener("click",()=>{t.classList.remove("active"),e.classList.add("active")})):console.error("Form switching elements are not defined.")}(async()=>{let s=a.artworksGrid;try{var e=await i(r.artworks);e.success&&s&&(s.innerHTML="",e.artworks.slice(0,6).forEach(e=>{var t=document.createElement("div");t.className="artwork",t.innerHTML=`
                        <img src="${e.image}" alt="${e.title}">
                        <h3>${e.title}</h3>
                    `,s.appendChild(t)}))}catch(e){console.error("Error loading artworks:",e)}})();(e=document.getElementById("registerForm"))&&(s=e).addEventListener("submit",async e=>{e.preventDefault();e=new FormData(s);try{var t=await i(r.register,{method:"POST",body:e});t.success?(s.reset(),alert("Registration successful!")):alert(t.error||"An error occurred.")}catch(e){console.error("Error during registration:",e)}});var s,o,t=document.getElementById("loginForm");t&&(o=t).addEventListener("submit",async e=>{e.preventDefault();e=new FormData(o);try{var t=await i(r.login,{method:"POST",body:e});t.success?window.location.reload():alert(t.error||"Invalid credentials.")}catch(e){console.error("Error during login:",e)}})})})(),document.addEventListener("DOMContentLoaded",function(){var e=document.getElementById("menu_toggle");let s=document.getElementById("nav_menu");e&&s?e.addEventListener("click",function(e){console.log("Menu toggle clicked"),this.classList.toggle("open"),console.log("Menu toggle has 'open' class:",this.classList.contains("open")),s.classList.toggle("active"),console.log("Nav menu has 'active' class:",s.classList.contains("active"));var t=window.getComputedStyle(s);console.log("Nav menu transform:",t.transform),console.log("Nav menu display:",t.display),console.log("Nav menu visibility:",t.visibility),console.log("Nav menu opacity:",t.opacity),e.preventDefault()}):console.error("Menu toggle or nav menu element not found!")}),document.addEventListener("DOMContentLoaded",function(){let s=document.querySelectorAll(".case-nav-btn"),o=document.querySelectorAll(".case-study-container");s.forEach(e=>{e.addEventListener("click",function(){let t=this.getAttribute("data-study");s.forEach(e=>e.classList.remove("active")),this.classList.add("active"),o.forEach(e=>{e.id===t+"-case"?e.classList.add("active"):e.classList.remove("active")})})})}),document.addEventListener("DOMContentLoaded",function(){let s=document.querySelectorAll(".case-nav-btn"),o=document.querySelectorAll(".case-study-container");0<s.length&&0<o.length&&s.forEach(e=>{e.addEventListener("click",function(){let t=this.getAttribute("data-study");s.forEach(e=>e.classList.remove("active")),this.classList.add("active"),o.forEach(e=>{e.style.opacity="0",setTimeout(()=>{e.classList.remove("active"),e.id===t+"-case"&&(e.classList.add("active"),setTimeout(()=>{e.style.opacity="1"},50))},300)})})}),document.querySelectorAll(".diagram-placeholder").forEach(r=>{if(!r.getAttribute("src")||r.getAttribute("src").includes("placeholder")){let e=r.parentElement,t=e.offsetWidth||600,s=r.getAttribute("alt").includes("E-Commerce")?"ecommerce":"samples",o="";o="ecommerce"==s?`
            <svg width="${t}" height="300" viewBox="0 0 ${t} 300" xmlns="http://www.w3.org/2000/svg">
                <style>
                    .box { fill: rgba(70, 130, 180, 0.1); stroke: rgba(70, 130, 180, 0.3); stroke-width: 1; }
                    .arrow { stroke: rgba(70, 130, 180, 0.5); stroke-width: 1.5; }
                    .text { fill: #AAAAAA; font-family: sans-serif; font-size: 12px; text-anchor: middle; }
                    .node-title { fill: #FFFFFF; font-family: sans-serif; font-size: 14px; text-anchor: middle; }
                </style>
                
                <!-- Website Node -->
                <rect class="box" x="50" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="110" y="95">Website</text>
                <text class="text" x="110" y="115">CUI Verification</text>
                
                <!-- Arrow 1 -->
                <line class="arrow" x1="170" y1="100" x2="220" y2="100" />
                <polygon points="220,95 230,100 220,105" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Verification Node -->
                <rect class="box" x="230" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="290" y="95">Verification</text>
                <text class="text" x="290" y="115">Database Check</text>
                
                <!-- Arrow 2 -->
                <line class="arrow" x1="350" y1="100" x2="400" y2="100" />
                <polygon points="400,95 410,100 400,105" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Request Node -->
                <rect class="box" x="410" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="470" y="95">Request System</text>
                <text class="text" x="470" y="115">Products/Technical</text>
                
                <!-- Arrow Down -->
                <line class="arrow" x1="470" y1="130" x2="470" y2="170" />
                <polygon points="465,170 470,180 475,170" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Staff Node -->
                <rect class="box" x="410" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="470" y="205">Staff</text>
                <text class="text" x="470" y="225">Notification</text>
                
                <!-- Connected Systems -->
                <rect class="box" x="50" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="110" y="205">Brevo API</text>
                <text class="text" x="110" y="225">Email Verification</text>
                
                <rect class="box" x="230" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="290" y="205">Database</text>
                <text class="text" x="290" y="225">Client Records</text>
                
                <!-- Connection Lines -->
                <line class="arrow" x1="110" y1="180" x2="110" y2="140" />
                <line class="arrow" x1="110" y1="140" x2="290" y2="140" />
                <line class="arrow" x1="290" y1="140" x2="290" y2="180" />
                
                <line class="arrow" x1="290" y1="180" x2="290" y2="150" />
                <line class="arrow" x1="290" y1="150" x2="410" y2="150" />
            </svg>`:`
            <svg width="${t}" height="300" viewBox="0 0 ${t} 300" xmlns="http://www.w3.org/2000/svg">
                <style>
                    .box { fill: rgba(70, 130, 180, 0.1); stroke: rgba(70, 130, 180, 0.3); stroke-width: 1; }
                    .arrow { stroke: rgba(70, 130, 180, 0.5); stroke-width: 1.5; }
                    .text { fill: #AAAAAA; font-family: sans-serif; font-size: 12px; text-anchor: middle; }
                    .node-title { fill: #FFFFFF; font-family: sans-serif; font-size: 14px; text-anchor: middle; }
                </style>
                
                <!-- Form Node -->
                <rect class="box" x="50" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="110" y="95">Request Form</text>
                <text class="text" x="110" y="115">Sales Agent</text>
                
                <!-- Arrow 1 -->
                <line class="arrow" x1="170" y1="100" x2="220" y2="100" />
                <polygon points="220,95 230,100 220,105" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Database Node -->
                <rect class="box" x="230" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="290" y="95">Database</text>
                <text class="text" x="290" y="115">Request Storage</text>
                
                <!-- Arrow 2 -->
                <line class="arrow" x1="350" y1="100" x2="400" y2="100" />
                <polygon points="400,95 410,100 400,105" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Zapier Node -->
                <rect class="box" x="410" y="70" width="120" height="60" rx="2" />
                <text class="node-title" x="470" y="95">Zapier</text>
                <text class="text" x="470" y="115">Automation Hub</text>
                
                <!-- Arrows to channels -->
                <line class="arrow" x1="470" y1="130" x2="470" y2="150" />
                <line class="arrow" x1="470" y1="150" x2="350" y2="150" />
                <line class="arrow" x1="470" y1="150" x2="590" y2="150" />
                
                <line class="arrow" x1="350" y1="150" x2="350" y2="170" />
                <polygon points="345,170 350,180 355,170" fill="rgba(70, 130, 180, 0.5)" />
                
                <line class="arrow" x1="590" y1="150" x2="590" y2="170" />
                <polygon points="585,170 590,180 595,170" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Email Node -->
                <rect class="box" x="290" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="350" y="205">Email</text>
                <text class="text" x="350" y="225">Client Notification</text>
                
                <!-- WhatsApp Node -->
                <rect class="box" x="530" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="590" y="205">WhatsApp</text>
                <text class="text" x="590" y="225">Messaggio API</text>
                
                <!-- Webhook Node -->
                <rect class="box" x="410" y="180" width="120" height="60" rx="2" />
                <text class="node-title" x="470" y="205">Webhook</text>
                <text class="text" x="470" y="225">Response Capture</text>
                
                <!-- Final Arrow -->
                <line class="arrow" x1="470" y1="240" x2="470" y2="260" />
                <polygon points="465,260 470,270 475,260" fill="rgba(70, 130, 180, 0.5)" />
                
                <!-- Marketing Node -->
                <rect class="box" x="410" y="270" width="120" height="60" rx="2" />
                <text class="node-title" x="470" y="295">Brevo</text>
                <text class="text" x="470" y="315">Marketing Automation</text>
            </svg>`;var a="data:image/svg+xml;charset=utf-8,"+encodeURIComponent(o);r.setAttribute("src",a)}})});