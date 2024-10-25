<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>React as a Library</title>
  <!-- Include React and ReactDOM via CDN -->
  <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
  <!-- Babel for JSX support -->
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
</head>
<body>
  <!-- React root element -->
  <div id="root"></div>
  <!-- React script -->
  <script type="text/babel">
    const json = <?php echo json_encode(["A","B","C"]); ?>;
    // Basic React component
    function App() {
      return (
        <div>
          <h1>Hello from React!</h1>
          <p>This is a React component rendered in an HTML page.</p>
        </div>
      );
    }

    // Render React component
    ReactDOM.createRoot(document.getElementById('root')).render(<App />);
  </script>
</body>
</html>
