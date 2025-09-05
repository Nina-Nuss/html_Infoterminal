class User {
    constructor(id, username, email, password, isAdmin) {
        this.id = id;
        this.username = username;
        this.email = email;
        this.password = password;
        this.isAdmin = isAdmin;
    }
    static remove_generate() {

    }
    static add_user() {

    }
    static edit_user() {

    }
    static delete_user() {

    }
    static event_remove(userId) {
        var checkBox = document.getElementById(`checkDelUser${userId}`);
        if (checkBox.checked == true) {
            // User löschen
        } else {
            // User nicht löschen
        }

    }
    static update() {
        var deleteUserTable = document.getElementById('deleteUser');
        deleteUserTable.innerHTML = '';
        this.get_all_users().then(users => {
            users.forEach(user => {
                deleteUserTable.innerHTML += `
                    <tr class="border-bottom">
                        <td class="p-2">${user.id}</td>
                        <td class="p-2">${user.username}</td>
                        <td class="p-2">${user.is_admin ? 'Ja' : 'Nein'}</td>
                        <td class="p-2"><input type="checkbox" id="checkDelUser${user.id}" onchange="User.event_remove(${user.id})"></td>
                    </tr>
                `;
            });
        });
    }
    static async get_all_users() {
        try {
            const response = await fetch('/src/database/selectUser.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const users = await response.json();
            return users;
        } catch (error) {
            console.error('Error fetching users:', error);
            return [];
        }
    }
}

User.update();
