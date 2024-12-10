# Push Notification Service

Welcome to the **Push Notification Service**! This project allows you to easily send and receive push notifications through Gotify, integrated into a Symfony backend, and offers a simple and user-friendly interface to display notifications.

## 🚀 Features

- **Send Notifications**: Use the API to send notifications to clients.
- **Real-Time Updates**: Notifications are fetched every 5 seconds, ensuring real-time delivery to clients.
- **Read/Unread Status**: Notifications automatically change their status to "read" when the client views them, making it easy to track user interactions.
- **Browser Notifications**: Notifications are displayed in the browser as well, providing a rich user experience.
  
## 📦 Technologies Used

- **Symfony**: A robust PHP framework for building the backend API.
- **Gotify**: A self-hosted push notification service to send notifications to client devices.
- **Doctrine ORM**: For database management and storing notification data.
- **JavaScript**: For dynamic updates in the client interface and browser notification functionality.
- **HTML/CSS**: For structuring and styling the client-side interface.

## 💡 How It Works

1. **Send Notification**: You can use the `/send-notification` endpoint to send a new notification. The notification gets stored in the database and is sent via Gotify.
2. **Receive Notifications**: The `/get-notifications` endpoint returns unread notifications, which will automatically be marked as read once they are displayed on the client interface.
3. **Client Interface**: A simple HTML page displays notifications and updates them to "read" once the client interacts with them.

## 🚀 Installation

### Prerequisites

- **PHP 8.0+**
- **Symfony 7.2**
- **Composer**
- **MySQL or PostgreSQL** (for the database)
- **Gotify Server** (self-hosted or external)

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/push-notification-project.git
cd push-notification-project
```

### Step 2: Install Dependencies

Install the PHP dependencies using Composer:

```bash
composer install
```

### Step 3: Configure Environment Variables

Copy the `.env.example` to `.env` and set up your Gotify server URL and token:

```bash
cp .env.example .env
```

Update the following variables in your `.env` file:

```env
GOTIFY_URL=https://your-gotify-server.com
GOTIFY_TOKEN=your-gotify-api-token
```

### Step 4: Set Up the Database

Run the following commands to set up your database:

```bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
```

### Step 5: Run the Symfony Server

```bash
php bin/console server:run
```

Now, your API is running, and you can start sending and receiving notifications!

---

## 🚀 Set Up Gotify with Docker

If you want to run your own Gotify server locally or in your environment, you can use Docker. Below is the command to initialize a Gotify instance and container using Docker:

```bash
docker run -d -p 8080:80 -v /path/to/data:/app/data gotify/server
```

- **`-d`**: Run the container in detached mode.
- **`-p 8080:80`**: Exposes the Gotify server on port 8080.
- **`-v /path/to/data:/app/data`**: Mounts a local directory (`/path/to/data`) to store Gotify data, such as notifications and configurations.

Replace `/path/to/data` with the actual path where you want to store the Gotify data on your system.

Once the Gotify container is running, you can access the Gotify dashboard by visiting `http://localhost:8080` in your browser.

---

## 🚀 API Endpoints

### **POST /send-notification**

Sends a new notification to Gotify and stores it in the database.

**Request Body**:

```json
{
  "title": "Notification Title",
  "message": "Notification Message"
}
```

**Response**:

```json
{
  "status": "Notification sent successfully!"
}
```

---

### **GET /get-notifications**

Fetches all unread notifications and marks them as read.

**Response**:

```json
[
  {
    "id": 1,
    "title": "Notification Title",
    "message": "Notification Message",
    "createdAt": "2024-12-10 12:00:00"
  }
]
```

---

## 🖥️ Client-Side Interface

The client interface is a simple HTML page that displays notifications and shows them as browser notifications.

1. **Display Notifications**: Notifications are shown in the browser as soon as they are received.
2. **Browser Notifications**: Once permission is granted, the client will receive browser notifications on new updates.

## 🛠️ Customization

You can customize the following settings:

- **Polling Interval**: Currently set to 5 seconds for fetching new notifications. Change the `setInterval(fetchNotifications, 5000)` value in `client.html` to adjust the interval.
- **Notification Styles**: Modify the `style` block in `client.html` for custom styling of notifications.

---

## 📜 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 💬 Contributing

If you'd like to contribute to this project, please fork the repository and submit a pull request with your changes. We welcome bug fixes, feature enhancements, and any other improvements!

---

## ✨ Acknowledgments

- Thanks to the **Gotify** project for providing a simple, open-source solution for push notifications.
- Symfony for the powerful backend framework.

---

## 🚀 Demo

[View the live demo](https://your-demo-url.com)

---

## 📞 Contact

For any questions or issues, feel free to open an issue or contact me directly at [kalleljawher4@gmail.com].
