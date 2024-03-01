<!DOCTYPE HTML>
<html>
	<head>
		<title>Safe url checker</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<h1>Safe url checker</h1>
				<p>A url checker powered by <a href="https://api-aries.online">API Aries</a>.</p>
			</header>

			<form id="signup-form" method="post" action="api.php">
				<input type="text" name="url" id="url" placeholder="Paste URL to check" />
				<input type="submit" value="Submit URL" />
			</form>
			
			<div id="result-section">
				<!-- Results will be displayed here -->
			</div>
			
			

		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; API Aries.</li><li>Credits: <a href="https://api-aries.online">API Aries</a></li>
				</ul>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/main.js"></script>


			<script>
				document.getElementById('signup-form').addEventListener('submit', function (event) {
					event.preventDefault();
				
					// Get the URL value from the form
					var url = document.getElementById('url').value;
				
					// Make an AJAX request to the PHP script
					var xhr = new XMLHttpRequest();
					xhr.open('POST', 'api.php', true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhr.onreadystatechange = function () {
						if (xhr.readyState === XMLHttpRequest.DONE) {
							if (xhr.status === 200) {
								// Parse the JSON response
								var response = JSON.parse(xhr.responseText);
				
								// Update the result section
								var resultSection = document.getElementById('result-section');
								if (response.error) {
									resultSection.innerHTML = 'Error: ' + response.error;
								} else {
									resultSection.innerHTML = response.safe ?
										'' + response.message :
										'This URL is not safe. Reason: ' + response.message;
								}
							} else {
								// Handle the error
								console.error('Error: ' + xhr.status);
							}
						}
					};
					xhr.send('url=' + encodeURIComponent(url));
				});
				</script>
				

	</body>
</html>