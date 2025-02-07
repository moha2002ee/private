document.addEventListener('DOMContentLoaded', () => {
    const boxes = document.querySelectorAll('.box');
    const backgroundMusic = document.getElementById('background-music');
    const messageElement = document.getElementById('animated-message');
    const themeToggle = document.getElementById('theme-toggle');
    const messages = [
        '<span class="comment">// Java</span>\n<span class="keyword">public class</span> HelloWorld {\n    <span class="keyword">public static void</span> main(String[] args) {\n        <span class="keyword">System.out.println</span>(<span class="string">"Hello, World!"</span>);\n    }\n}',
        '<span class="comment">// C</span>\n<span class="keyword">#include</span> <span class="string">&lt;stdio.h&gt;</span>\n<span class="keyword">int</span> main() {\n    <span class="keyword">printf</span>(<span class="string">"Hello, World!\\n"</span>);\n    <span class="keyword">return</span> 0;\n}',
        '<span class="comment">// C++</span>\n<span class="keyword">#include</span> <span class="string">&lt;iostream&gt;</span>\n<span class="keyword">int</span> main() {\n    <span class="keyword">std::cout</span> << <span class="string">"Hello, World!"</span> << <span class="keyword">std::endl</span>;\n    <span class="keyword">return</span> 0;\n}',
        '<span class="comment">// Python</span>\n<span class="keyword">print</span>(<span class="string">"Hello, World!"</span>)',
        '<span class="comment">// JavaScript</span>\n<span class="keyword">console.log</span>(<span class="string">"Hello, World!"</span>);',
        '<span class="comment">// PHP</span>\n<span class="keyword">&lt;?php</span>\n<span class="keyword">echo</span> <span class="string">"Hello, World!"</span>;\n<span class="keyword">?&gt;</span>',
        '<span class="comment">// Swift</span>\n<span class="keyword">import</span> Foundation\n<span class="keyword">print</span>(<span class="string">"Hello, World!"</span>)',
        '<span class="comment">// Kotlin</span>\n<span class="keyword">fun</span> main() {\n    <span class="keyword">println</span>(<span class="string">"Hello, World!"</span>)\n}',
        '<span class="comment">// Ruby</span>\n<span class="keyword">puts</span> <span class="string">"Hello, World!"</span>',
        '<span class="comment">// Go</span>\n<span class="keyword">package</span> main\n<span class="keyword">import</span> <span class="string">"fmt"</span>\n<span class="keyword">func</span> main() {\n    <span class="keyword">fmt.Println</span>(<span class="string">"Hello, World!"</span>)\n}',
        '<span class="comment">// Rust</span>\n<span class="keyword">fn</span> main() {\n    <span class="keyword">println!</span>(<span class="string">"Hello, World!"</span>);\n}',
        '<span class="comment">// Dart</span>\n<span class="keyword">void</span> main() {\n    <span class="keyword">print</span>(<span class="string">"Hello, World!"</span>);\n}',
        '<span class="comment">// TypeScript</span>\n<span class="keyword">console.log</span>(<span class="string">"Hello, World!"</span>);',
        '<span class="comment">// Bash</span>\n<span class="keyword">#!/bin/bash</span>\n<span class="keyword">echo</span> <span class="string">"Hello, World!"</span>',
        '<span class="comment">// R</span>\n<span class="keyword">cat</span>(<span class="string">"Hello, World!\\n"</span>)',
        '<span class="comment">// Perl</span>\n<span class="keyword">print</span> <span class="string">"Hello, World!\\n"</span>;',
        '<span class="comment">// Scala</span>\n<span class="keyword">object</span> HelloWorld {\n    <span class="keyword">def</span> main(args: Array[String]): <span class="keyword">Unit</span> = {\n        <span class="keyword">println</span>(<span class="string">"Hello, World!"</span>)\n    }\n}'
    ];

    boxes.forEach((box, index) => {
        box.style.animationDelay = `${index * 0.2}s`;
        box.addEventListener('mouseover', () => {
            box.classList.add('hover');
        });
        box.addEventListener('mouseout', () => {
            box.classList.remove('hover');
        });
    });

    // Play the background music
    const playMusic = () => {
        backgroundMusic.play().catch(error => {
            console.log('Autoplay was prevented:', error);
        });
    };

    // Ensure the music continues to play in the background
    backgroundMusic.addEventListener('ended', () => {
        backgroundMusic.play();
    });

    // Request user interaction to start the music
    document.body.addEventListener('click', playMusic, { once: true });

    // Animate the messages
    let messageIndex = 0;
    let charIndex = 0;

    const typeMessage = () => {
        if (charIndex < messages[messageIndex].length) {
            const currentChar = messages[messageIndex].charAt(charIndex);
            if (currentChar === '<') {
                const endTagIndex = messages[messageIndex].indexOf('>', charIndex);
                messageElement.innerHTML += messages[messageIndex].substring(charIndex, endTagIndex + 1);
                charIndex = endTagIndex + 1;
            } else {
                messageElement.innerHTML += currentChar;
                charIndex++;
            }
            setTimeout(typeMessage, 50);
        } else {
            setTimeout(() => {
                messageElement.classList.remove('typing');
                messageElement.classList.add('erasing');
                setTimeout(() => {
                    messageElement.innerHTML = '';
                    messageElement.classList.remove('erasing');
                    messageElement.classList.add('typing');
                    charIndex = 0;
                    messageIndex = (messageIndex + 1) % messages.length;
                    setTimeout(typeMessage, 1000);
                }, 2000);
            }, 2000);
        }
    };

    messageElement.classList.add('typing');
    typeMessage();

    // Function to update the time and date
    const updateTimeAndDate = () => {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const period = hours >= 12 ? 'PM' : 'AM';
        const formattedHours = hours % 12 || 12;
        const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
        const timeString = `${formattedHours}:${formattedMinutes}`;
        const dateString = now.toLocaleDateString('en-US', { weekday: 'long', month: 'long', day: 'numeric' });

        document.getElementById('current-time').textContent = timeString;
        document.getElementById('current-period').textContent = period;
        document.getElementById('current-date').textContent = dateString;
    };

    // Function to fetch weather data
    const fetchWeather = async () => {
        const apiKey = 'YOUR_API_KEY'; // Remplacez par votre clé API
        const lat = 50.5939; // Latitude de Verviers
        const lon = 5.8624; // Longitude de Verviers
        const url = `https://api.openweathermap.org/data/3.0/onecall?lat=${lat}&lon=${lon}&exclude=minutely,hourly,daily,alerts&appid=${apiKey}&units=metric`;

        try {
            const response = await fetch(url);
            const data = await response.json();
            const temperature = data.current.temp;
            const weatherDescription = data.current.weather[0].description;

            document.getElementById('weather').textContent = `Weather in Verviers: ${temperature}°C, ${weatherDescription}`;
        } catch (error) {
            console.error('Error fetching weather data:', error);
        }
    };

    // Update time and date every second
    setInterval(updateTimeAndDate, 1000);
    updateTimeAndDate();

    // Fetch weather data
    fetchWeather();

    // Toggle theme
    themeToggle.addEventListener('change', () => {
        document.body.classList.toggle('dark-theme', themeToggle.checked);
    });
});