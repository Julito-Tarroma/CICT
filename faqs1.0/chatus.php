<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSU Chat Support</title>
    <style>
        /* Catanduanes State University Color Scheme */
        :root {
            --csu-blue: #0056b3;
            --csu-dark-blue: #003366;
            --csu-light-blue: #e6f2ff;
            --csu-gold: #FFD700;
            --csu-white: #FFFFFF;
            --csu-light-gray: #f5f5f5;
            --csu-dark-gray: #333333;
        }

        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--csu-light-gray);
        }
        
/* Updated Emoji Styling */
.bg-bubbles li {
    position: absolute;
    list-style: none;
    display: block;
    width: auto; /* Changed from fixed width */
    height: auto; /* Changed from fixed height */
    background-color: transparent !important; /* Remove background */
    bottom: -160px;
    animation: square 25s infinite;
    transition-timing-function: linear;
    border-radius: 0; /* Remove border radius */
    font-size: 24px; /* Larger emoji size */
    line-height: 1;
    text-align: center;
    opacity: 0.8;
}

/* Adjust individual emoji sizes */
.bg-bubbles li:nth-child(1) {
    left: 10%;
    font-size: 48px; /* Larger emoji */
    animation-delay: 0s;
    animation-duration: 17s;
}

.bg-bubbles li:nth-child(2) {
    left: 20%;
    font-size: 28px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.bg-bubbles li:nth-child(3) {
    left: 25%;
    font-size: 32px;
    animation-delay: 4s;
}

.bg-bubbles li:nth-child(4) {
    left: 40%;
    font-size: 40px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.bg-bubbles li:nth-child(5) {
    left: 70%;
    font-size: 36px;
}

.bg-bubbles li:nth-child(6) {
    left: 80%;
    font-size: 60px;
    animation-delay: 3s;
}

.bg-bubbles li:nth-child(7) {
    left: 32%;
    font-size: 72px;
    animation-delay: 7s;
}

.bg-bubbles li:nth-child(8) {
    left: 55%;
    font-size: 28px;
    animation-delay: 15s;
    animation-duration: 40s;
}

.bg-bubbles li:nth-child(9) {
    left: 25%;
    font-size: 24px;
    animation-delay: 2s;
    animation-duration: 40s;
}

.bg-bubbles li:nth-child(10) {
    left: 90%;
    font-size: 64px;
    animation-delay: 11s;
}
        @keyframes square {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
            }
        }


        /* Back Button Styling */
        .back-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: var(--csu-dark-blue);
            color: var(--csu-white);
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 1000;
        }

        .back-button:hover {
            background: var(--csu-blue);
            transform: translateY(-2px);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
        }

        /* Floating Chatbox */
        .chatbox {
            width: 90%;
            max-width: 800px;
            height: 80vh;
            min-height: 600px;
            background: var(--csu-white);
            border-radius: 15px;
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.1);
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 999;
            position: relative;
        }

        .chatbox.active {
            transform: translateY(0);
            opacity: 1;
        }

        /* Chat Header */
        .chat-header {
            background: linear-gradient(135deg, var(--csu-dark-blue), var(--csu-blue));
            color: var(--csu-white);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 22px;
            font-weight: bold;
            position: relative;
        }

        .chat-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--csu-gold);
        }

        .chat-logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .chat-logo img {
            height: 35px;
        }

        .close-btn {
            cursor: pointer;
            font-size: 32px;
            font-weight: normal;
            transition: transform 0.2s;
            padding: 5px;
        }

        .close-btn:hover {
            transform: scale(1.2);
        }

        /* Chat Body */
        .chat-body {
            flex: 1;
            padding: 25px;
            font-size: 17px;
            overflow-y: auto;
            background: var(--csu-light-gray);
            display: flex;
            flex-direction: column;
            gap: 20px;
            background-image: url('https://www.csu.edu.ph/wp-content/themes/csu/images/bg-pattern.png');
            background-blend-mode: overlay;
            background-color: rgba(245, 245, 245, 0.9);
        }

        /* Chat Messages */
        .message {
            padding: 15px 20px;
            border-radius: 15px;
            max-width: 75%;
            font-size: 16px;
            line-height: 1.5;
            position: relative;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
            word-wrap: break-word;
        }

        .received {
            background: var(--csu-white);
            align-self: flex-start;
            border-top-left-radius: 5px;
            color: var(--csu-dark-gray);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .received::before {
            content: '';
            position: absolute;
            left: -10px;
            top: 15px;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-right: 10px solid var(--csu-white);
        }

        .sent {
            background: linear-gradient(135deg, var(--csu-blue), var(--csu-dark-blue));
            color: var(--csu-white);
            align-self: flex-end;
            border-top-right-radius: 5px;
        }

        .sent::before {
            content: '';
            position: absolute;
            right: -10px;
            top: 15px;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-left: 10px solid var(--csu-blue);
        }

        /* Timestamp */
        .timestamp {
            display: block;
            font-size: 12px;
            opacity: 0.7;
            margin-top: 8px;
            text-align: right;
        }

        /* Chat Input */
        .chat-input {
            display: flex;
            padding: 20px;
            background: var(--csu-white);
            border-top: 1px solid #ddd;
            align-items: center;
        }

        .chat-input input {
            flex: 1;
            padding: 16px 20px;
            font-size: 16px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 30px;
            outline: none;
            background: var(--csu-light-gray);
            transition: all 0.3s ease;
        }

        .chat-input input:focus {
            border-color: var(--csu-blue);
            box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.2);
        }

        .chat-input button {
            padding: 16px;
            width: 55px;
            height: 55px;
            font-size: 20px;
            margin-left: 15px;
            border: none;
            background: linear-gradient(135deg, var(--csu-blue), var(--csu-dark-blue));
            color: var(--csu-white);
            cursor: pointer;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .chat-input button:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 86, 179, 0.3);
        }

        /* Chat Toggle Button */
        .chat-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, var(--csu-blue), var(--csu-dark-blue));
            color: var(--csu-white);
            width: 80px;
            height: 80px;
            font-size: 26px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0px 10px 25px rgba(0, 86, 179, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .chat-toggle:hover {
            transform: scale(1.1) translateY(-5px);
            box-shadow: 0px 15px 30px rgba(0, 86, 179, 0.4);
        }

        /* Typing Animation */
        .typing {
            display: flex;
            align-items: center;
            padding: 10px 15px;
        }

        .typing-dot {
            width: 10px;
            height: 10px;
            margin: 0 3px;
            background-color: #999;
            border-radius: 50%;
            display: inline-block;
            animation: typingAnimation 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) {
            animation-delay: 0s;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typingAnimation {
            0%, 60%, 100% {
                transform: translateY(0);
            }
            30% {
                transform: translateY(-5px);
            }
        }

        /* Welcome Message */
        .welcome-message {
            text-align: center;
            padding: 20px;
            background: rgba(0, 86, 179, 0.1);
            border-radius: 15px;
            margin-bottom: 20px;
            border: 1px dashed rgba(0, 86, 179, 0.3);
        }

        .welcome-message h3 {
            color: var(--csu-dark-blue);
            margin-bottom: 10px;
            font-size: 22px;
        }

        .welcome-message p {
            color: var(--csu-dark-gray);
            font-size: 16px;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 86, 179, 0.3);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 86, 179, 0.5);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .chatbox {
                width: 95%;
                height: 85vh;
                min-height: auto;
            }
            
            .chat-header {
                padding: 15px;
                font-size: 20px;
            }
            
            .chat-body {
                padding: 15px;
            }
            
            .message {
                max-width: 85%;
                padding: 12px 16px;
            }
        }
         /* Scrollbar Styling */
         ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 86, 179, 0.3);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 86, 179, 0.5);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .chatbox {
                width: 95%;
                height: 85vh;
                min-height: auto;
            }
            
            .chat-header {
                padding: 15px;
                font-size: 20px;
            }
            
            .chat-body {
                padding: 15px;
            }
            
            .message {
                max-width: 85%;
                padding: 12px 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <ul class="bg-bubbles">
    <li>🎓</li>
    <li>📚</li>
    <li>💻</li>
    <li>📖</li>
    <li>🖋️</li>
    <li>📝</li>
    <li>🎯</li>
    <li>🏫</li>
    <li>🧠</li>
    <li>🏆</li>
</ul>

    </style>
</head>
<body>

    <!-- Back Button -->
    <a href="homepage.php" class="back-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
        Back
    </a>

    <!-- Chat Open Button -->
    <div class="chat-toggle" onclick="toggleChat()">💬</div>

    <div class="chatbox active" id="chatbox">
        <div class="chat-header">
            <div class="chat-logo">
                <span>CICT Chat Support</span>
            </div>
            <span class="close-btn" onclick="toggleChat()">×</span>
        </div>
        <div class="chat-body" id="chat-body">
            <div class="welcome-message">
                <h3>Welcome to CICT Support</h3>
                <p>How can we assist you today? Ask about Shifting, Transfering, or Academic Requirements.</p>
            </div>
        </div>
        <div class="chat-input">
            <input type="text" id="chat-input" placeholder="Type your message here...">
            <button id="send-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                </svg>
            </button>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Auto-focus input when chat opens
        document.getElementById('chat-input').focus();
    });

    function toggleChat() {
        const chatbox = document.getElementById("chatbox");
        chatbox.classList.toggle("active");
        
        if (chatbox.classList.contains("active")) {
            document.getElementById('chat-input').focus();
        }
    }

    document.getElementById("send-btn").addEventListener("click", sendMessage);
    document.getElementById("chat-input").addEventListener("keypress", function (e) {
        if (e.key === "Enter") sendMessage();
    });

    function getCurrentTime() {
        const now = new Date();
        return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    function sendMessage() {
        let inputField = document.getElementById("chat-input");
        let message = inputField.value.trim();
        if (message === "") return;

        let chatBody = document.getElementById("chat-body");

        // Add user message
        let userMessage = document.createElement("div");
        userMessage.className = "message sent";
        userMessage.innerHTML = message + `<span class="timestamp">${getCurrentTime()}</span>`;
        chatBody.appendChild(userMessage);

        // Show typing animation
        let typingIndicator = document.createElement("div");
        typingIndicator.className = "message received";
        typingIndicator.innerHTML = `
            <div class="typing">
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
            </div>
        `;
        chatBody.appendChild(typingIndicator);
        chatBody.scrollTop = chatBody.scrollHeight;

        // Simulate response delay
        setTimeout(() => {
            chatBody.removeChild(typingIndicator);
            
            // Send message to PHP
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "chatbot.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let botMessage = document.createElement("div");
                    botMessage.className = "message received";
                    botMessage.innerHTML = xhr.responseText + `<span class="timestamp">${getCurrentTime()}</span>`;
                    chatBody.appendChild(botMessage);

                    // Auto-scroll to bottom
                    chatBody.scrollTop = chatBody.scrollHeight;
                }
            };
            xhr.send("message=" + encodeURIComponent(message));
        }, 1500 + Math.random() * 1000); // Random delay between 1.5-2.5 seconds

        // Clear input field
        inputField.value = "";
    }
    </script>
</body>
</html>