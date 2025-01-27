import os
import json
from http.server import BaseHTTPRequestHandler, HTTPServer
import google.generativeai as genai

class MyHandler(BaseHTTPRequestHandler):  
    def do_POST(self):
        # Get the content length from the headers
        content_length = int(self.headers['Content-Length'])
        post_data = self.rfile.read(content_length)
        
        # Decode the JSON data
        received_data = json.loads(post_data.decode('utf-8'))
        print("Received data from PHP:", received_data)
        # Check if 'message' exists
        if "message" in received_data:
            print("Content for Validation:", received_data["message"])
        else:
            print("Error: 'message' key not found in incoming data")

        # Configure the GenAI API (Replace 'API_KEY' with your actual key)
        genai.configure(api_key="AIzaSyDpS_N6qjbfTXSJ9dsXXySY95kP4UjK-Y8")

        # Create the model
        generation_config = {
          "temperature": 1,
          "top_p": 0.95,
          "top_k": 40,
          "max_output_tokens": 8192,
          "response_mime_type": "text/plain",
        }

        model = genai.GenerativeModel(
          model_name="gemini-1.5-flash",
          generation_config=generation_config,
          system_instruction="Analyze the following text for factual accuracy and plagiarism. Verify the claims made in the content against reliable real-world data sources, fact-check key statements, and identify any discrepancies or false information. Additionally, check for plagiarism by comparing the text with publicly available content and databases. Provide a detailed report highlighting factual inaccuracies, sources for verification, and plagiarism percentage, along with matched sources if any. Ensure clarity and conciseness in the response. give m the response in json format {fact:true} if it correct and {fact:false} if it is wrong ",
        )

        chat_session = model.start_chat(
          history=[]
        )

        # Interact with the AI model
        response = chat_session.send_message(received_data["message"])
        print("Generated Response:", response.text)
        
        # Prepare the response JSON
        response_data = {
            "reply": f"{response.text}",
           
        }
        response_json = json.dumps(response_data)
        
        # Send response
        self.send_response(200)
        self.send_header('Content-Type', 'application/json')
        self.end_headers()
        self.wfile.write(response_json.encode('utf-8'))

# Start the server
server_address = ('', 8000)  # Listening on port 8000
httpd = HTTPServer(server_address, MyHandler)
print("Python server is running...")
httpd.serve_forever()