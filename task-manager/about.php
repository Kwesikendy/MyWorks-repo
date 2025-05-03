<!DOCTYPE html>
<html>
<head>
    <title>About This App</title>
    <style>
        :root {
            --primary: #4a90e2;
            --secondary: #6c5ce7;
            --text: #2d3436;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transform: translateY(0);
            animation: slideUp 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        h1 {
            color: var(--primary);
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
            animation: textPop 0.8s ease-out;
        }

        h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--secondary);
            margin: 1rem auto;
            border-radius: 2px;
        }

        p {
            color: var(--text);
            font-size: 1.1rem;
            line-height: 1.8;
            margin: 2rem 0;
            opacity: 0;
            animation: fadeIn 0.8s 0.3s forwards;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            opacity: 0;
            animation: fadeIn 0.8s 0.6s forwards;
        }

        .back-link:hover {
            transform: translateX(-5px);
            color: var(--secondary);
        }

        .back-link::before {
            content: '←';
            margin-right: 8px;
            transition: margin 0.3s ease;
        }

        .back-link:hover::before {
            margin-right: 12px;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes textPop {
            0% {
                letter-spacing: -0.5em;
                opacity: 0;
            }
            100% {
                letter-spacing: normal;
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>About My Task Manager</h1>
        <p>A simple PHP/MySQL project to organize daily tasks. No fluff, just productivity! Built with modern web practices and a focus on user experience.</p>
        <a href="index.php" class="back-link">Back to Tasks</a>
    </div>
</body>
</html>