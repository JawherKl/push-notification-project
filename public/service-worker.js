// Listen for the push event
self.addEventListener('push', function(event) {
    // The message data received with the push event (from server)
    const data = event.data.json();

    // Show a notification
    event.waitUntil(
        self.registration.showNotification(data.title, {
            body: data.message,
            icon: '/images/notification-icon.png', // optional
        })
    );
});
