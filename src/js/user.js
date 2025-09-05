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
    static add_user(){

    }
    static edit_user(){

    }
    static delete_user(){

    }
    static async get_all_users(){
        try{
            const response = await fetch('/src/database/getAllUsers.php', {
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
 