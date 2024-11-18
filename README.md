
# Quiz Web Application 

This is a web-based quiz application that allows users to take quizzes in various subjects like Math, Science, and Social Science. The app requires user authentication (login) and displays personalized content based on the logged-in user's details.


## Features

- User Authentication: Users can log in with their email and view personalized content
- Subject-based Quizzes: Quizzes are categorized by subjects like Math, Science, and Social Science.
- Dynamic User Interface: User's name is dynamically displayed on the dashboard after login.



## Technologies Used

**Frontend:** HTML5, CSS3, JavaScript (for dynamic interaction), FontAwesome (for icons), Google Fonts (for custom fonts).

**Backend:** PHP, MySQL.


## Installation

1. Clone the repository:

```bash
git clone https://github.com/your-username/quiz-web-app.git
```

2. Set up the environment:
Make sure you have PHP and MySQL installed on your system. If you don't have them installed, you can use XAMPP or WAMP for local development.

3. Configure the database:
Create a database in MySQL and import the necessary tables. Here’s an example of a user table structure:

```bash
CREATE TABLE user (
    id INT(11) PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

4. Update the database connection:
In your PHP script, update the database connection settings ($conn) to match your local environment:

```bash
$conn = mysqli_connect("localhost", "root", "", "quiz");
```

5. Run the project:
Once the environment is set up and the database is configured, you can run the project on your local server (e.g., localhost or localhost/quiz).
## Usage

- Login: Users can log in using their email. After successful login, their name will be displayed on the dashboard.
- Quizzes: After logging in, users can choose from various subjects (Math, Science, Social Science) and start a quiz by clicking on any of the available options.\
- Logout: Users can log out via the menu button, which will end their session.


## Screenshots

1. HOME PAGE
![image](https://github.com/user-attachments/assets/d3c5c511-4b78-4e4d-9546-f057a1d35518)

2. SIGNUP & PAGE
![image](https://github.com/user-attachments/assets/89fbe548-9d13-4ccc-9c13-8de2bb5cae6f)

![image](https://github.com/user-attachments/assets/95bb0ec5-0d36-4b3c-9c7c-b3b03568d27f)

3. QUIZ PAGE
![image](https://github.com/user-attachments/assets/8fc33fde-18a3-4919-ac42-94dc22a2b20c)

4. QUIZ SECTION
![image](https://github.com/user-attachments/assets/3683ce28-4426-446d-ac2b-358d311da8ce)

5. DASHBOARD
![image](https://github.com/user-attachments/assets/f08b45d2-eac7-40dd-99f7-bfa18b8f1c34)

6. ACTIVITY 
![image](https://github.com/user-attachments/assets/85b2a72d-9f57-41ba-ae17-ea33d1456922)


