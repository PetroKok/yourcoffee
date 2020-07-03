self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        //notifications aren't supported or permission not granted!
        return;
    }

    if (e.data) {
        var msg = {
            body: "This is the text",
            icon: "",
            action: "/",
        };

        console.log(e.data);
        // if (e.data !== null) {
        //     msg = e.data.json();
        // }
        e.waitUntil(self.registration.showNotification(msg.title, {
            body: msg.body,
            icon: msg.icon,
            actions: msg.actions
        }));
    }
});
