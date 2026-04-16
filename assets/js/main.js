// Simple Mock Chatbot logic for the "Pro Touch"
document.addEventListener("DOMContentLoaded", () => {
    // Inject chatbot HTML into body
    const chatHTML = `
    <div id="mockChatbot" style="position:fixed; bottom:30px; right:30px; z-index:9999;">
        <!-- Chat Window -->
        <div id="chatWindow" style="display:none; width:300px; height:400px; background:var(--bg-color); border:1px solid var(--primary); border-radius:12px; box-shadow:var(--glow); flex-direction:column; overflow:hidden;">
            <div style="background:var(--primary); padding:15px; color:#fff; font-weight:800; display:flex; justify-content:space-between; align-items:center;">
                <span>Fitness Support</span>
                <span id="closeChat" style="cursor:pointer;">✖</span>
            </div>
            <div id="chatBody" style="flex:1; padding:15px; overflow-y:auto; font-size:14px; background:rgba(255,255,255,0.02);">
                <div style="background:rgba(255,255,255,0.1); padding:10px; border-radius:8px; margin-bottom:10px; max-width:80%;">
                    Hi there! How can I help you transform today?
                </div>
            </div>
            <div style="padding:15px; border-top:1px solid var(--border); display:flex;">
                <input type="text" id="chatInput" placeholder="Type a message..." style="flex:1; padding:10px; background:transparent; border:1px solid var(--border); color:#fff; border-radius:4px; outline:none; font-family:'Outfit', sans-serif;">
                <button id="chatSend" class="btn btn-primary" style="padding:10px 15px; margin-left:10px; border-radius:4px; font-size:12px;">Send</button>
            </div>
        </div>
        
        <!-- Floating Bubble -->
        <div id="chatBubble" style="width:60px; height:60px; background:var(--primary); border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow:var(--glow); margin-left:auto; margin-top:20px; font-size:24px;">
            💬
        </div>
    </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', chatHTML);

    const chatBubble = document.getElementById('chatBubble');
    const chatWindow = document.getElementById('chatWindow');
    const closeChat = document.getElementById('closeChat');
    const chatInput = document.getElementById('chatInput');
    const chatSend = document.getElementById('chatSend');
    const chatBody = document.getElementById('chatBody');

    chatBubble.addEventListener('click', () => {
        chatWindow.style.display = 'flex';
        chatBubble.style.display = 'none';
    });

    closeChat.addEventListener('click', () => {
        chatWindow.style.display = 'none';
        chatBubble.style.display = 'flex';
    });

    chatSend.addEventListener('click', () => {
        const msg = chatInput.value.trim();
        if(msg) {
            // User message
            const userDiv = document.createElement('div');
            userDiv.style.cssText = 'background:var(--secondary); color:#000; padding:10px; border-radius:8px; margin-bottom:10px; max-width:80%; margin-left:auto;';
            userDiv.innerText = msg;
            chatBody.appendChild(userDiv);
            chatInput.value = '';
            
            // Bot reply
            setTimeout(() => {
                const botDiv = document.createElement('div');
                botDiv.style.cssText = 'background:rgba(255,255,255,0.1); padding:10px; border-radius:8px; margin-bottom:10px; max-width:80%;';
                botDiv.innerText = 'Thanks for your message. An agent will be with you shortly... (Simulation)';
                chatBody.appendChild(botDiv);
                chatBody.scrollTop = chatBody.scrollHeight;
            }, 1000);
        }
    });

    chatInput.addEventListener('keypress', (e) => {
        if(e.key === 'Enter') chatSend.click();
    });
});
