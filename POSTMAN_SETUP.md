# Postman Collection Setup Guide

## How to Import the Collection

1. **Open Postman**
2. **Click Import** (top left corner)
3. **Select the file**: `Universiteti_Backend_API.postman_collection.json`
4. **Click Import**

The collection includes **all your APIs** organized in folders: Authentication, Students, Pedagogues, and OAuth.

## Collection Structure

### 📁 Authentication Folder (5 requests)
- **Register** - Create a new user account
- **Login** - Login and get authentication token  
- **Complete Profile** - Complete profile after OAuth registration
- **Get Current User** - Get authenticated user details
- **Logout** - Logout current session

### 📁 Students Folder (5 requests)
- **Get All Students** - Retrieve list of all students
- **Get Student By ID** - Get specific student details
- **Create Student** - Add a new student
- **Update Student** - Update existing student
- **Delete Student** - Remove a student

### 📁 Pedagogues Folder (5 requests)
- **Get All Pedagogues** - Retrieve list of all pedagogues
- **Get Pedagogue By ID** - Get specific pedagogue details
- **Create Pedagogue** - Add a new pedagogue
- **Update Pedagogue** - Update existing pedagogue
- **Delete Pedagogue** - Remove a pedagogue

### 📁 OAuth Folder (2 requests)
- **Redirect to Google** - Initiate Google OAuth login
- **Google Callback** - Handle Google OAuth callback

## How to Use

### Step 1: Configure Variables
The collection is pre-configured with these variables:
- **base_url**: `http://localhost:8085/api` (for Docker setup)
- **auth_token**: (auto-saved when you login)
- **student_id**: `STU001` (you can change this or it auto-updates when you create a student)
- **pedagogue_id**: `PED001` (you can change this or it auto-updates when you create a pedagogue)

If your server runs on a different URL or port, update the variable:
1. Click on the collection name
2. Go to **Variables** tab
3. Update `base_url` value

**Common base URLs:**
- Docker: `http://localhost:8085/api`
- Standard Laravel: `http://localhost:8000/api`

### Step 2: Authenticate
Before testing protected endpoints, you must authenticate:

1. **Option A - Register a new user:**
   - Run the **Register** request
   - The auth token will be automatically saved

2. **Option B - Login with existing user:**
   - Run the **Login** request
   - The auth token will be automatically saved

💡 **The collection automatically saves your auth token** when you login/register and uses it for all protected endpoints.

### Step 3: Test API Endpoints

All protected endpoints use the auth token automatically. Just run them:

**Students:**
1. **Create a Student** - Creates a new student (auto-saves the student_id)
2. **Get All Students** - View all students
3. **Get Student By ID** - View specific student (uses `{{student_id}}` variable)
4. **Update Student** - Modify student details
5. **Delete Student** - Remove a student

**Pedagogues:**
1. **Create a Pedagogue** - Creates a new pedagogue (auto-saves the pedagogue_id)
2. **Get All Pedagogues** - View all pedagogues
3. **Get Pedagogue By ID** - View specific pedagogue (uses `{{pedagogue_id}}` variable)
4. **Update Pedagogue** - Modify pedagogue details
5. **Delete Pedagogue** - Remove a pedagogue

💡 **Tip**: The "Get/Update/Delete by ID" requests use variables (`{{student_id}}`, `{{pedagogue_id}}`), so you can change them once in the Variables tab to test different records!

## Data Fields Reference

### Student Fields

When creating or updating students, use these fields:

```json
{
  "stu_id": "STU001",              // Student ID (string, required for create)
  "stu_em": "John",                 // First name
  "stu_mb": "Doe",                  // Last name
  "stu_atesi": "Jane Doe",          // Parent name
  "stu_gjini": "M",                 // Gender (M/F)
  "stu_dl": "2000-01-15",          // Date of birth (YYYY-MM-DD)
  "stu_nuid": "1234567890",        // National ID
  "stu_email": "student@email.com", // Email
  "stu_dat_regjistrim": "2026-01-01", // Registration date (YYYY-MM-DD)
  "stu_status": "active",          // Status
  "dep_id": 1                      // Department ID (integer)
}
```

### Pedagogue Fields

When creating or updating pedagogues, use these fields:

```json
{
  "ped_id": "PED001",              // Pedagogue ID (string, required for create)
  "ped_em": "Maria",                // First name
  "ped_mb": "Johnson",              // Last name
  "ped_gjin": "F",                  // Gender (M/F)
  "ped_tit": "Professor",           // Title (Professor, Associate Professor, etc.)
  "ped_dl": "1980-05-20",          // Date of birth (YYYY-MM-DD)
  "ped_tel": "+38344555666",       // Phone number
  "ped_email": "pedagogue@email.com", // Email
  "ped_dt": "2020-09-01",          // Start date (YYYY-MM-DD)
  "dep_id": 1                      // Department ID (integer)
}
```

## Adding More APIs Later

When you create new APIs (Fakultet, Departament, etc.), you can easily add them to this collection:

### Option 1: Add Manually in Postman
1. Open the collection in Postman
2. Right-click the collection name → **Add Folder**
3. Name it (e.g., "Fakultet", "Departament")
4. Right-click the new folder → **Add Request**
5. Configure your endpoints

### Option 2: Edit the JSON File
1. Open `Universiteti_Backend_API.postman_collection.json`
2. Find the `"item": [` array (contains all folders)
3. Add a new folder object following the same structure as Students or Pedagogues

All new endpoints will automatically use the shared `{{auth_token}}` and `{{base_url}}` variables!

## Tips

- ✅ **Auto-token management**: Login/Register requests automatically save your auth token
- ✅ **Auto-ID saving**: Create requests automatically update ID variables for easy testing
- ✅ **Reusable variables**: All requests use `{{base_url}}`, `{{auth_token}}`, and ID variables
- 📝 **Test Scripts**: The collection includes test scripts that save tokens and IDs automatically
- 🔐 **Bearer Token Auth**: All protected endpoints automatically include your auth token
- 📂 **Organized folders**: Each API type in its own folder - easy to navigate and extend

## Troubleshooting

### 401 Unauthorized
- Your auth token is missing or expired
- Run **Login** or **Register** again

### 404 Not Found
- Check that your student/pedagogue ID exists
- Use **Get All** endpoints to see available IDs

### 422 Validation Error
- Check that all required fields are provided
- Verify date formats (YYYY-MM-DD)
- Ensure dep_id exists in the database

### Server Not Running
- Make sure your Laravel server is running: `php artisan serve`
- Or if using Docker, ensure containers are up

## Running the Server

If you haven't started your server yet:

```bash
# Standard Laravel
php artisan serve

# Or with Docker
docker-compose up
```

The API will be available at:
- **Docker**: `http://localhost:8085/api`
- **Standard Laravel**: `http://localhost:8000/api`

## Important Notes

### API Routes Prefix
All API routes are prefixed with `/api/`. For example:
- ✅ Correct: `http://localhost:8085/api/login`
- ❌ Wrong: `http://localhost:8085/login`

### Request Methods
- **Login/Register** require POST requests with JSON body (use Postman, not browser)
- **GET requests** can be tested in browser once authenticated (but you need to pass the token)

## OAuth Testing

For **Google OAuth** endpoints:
- The **Redirect to Google** endpoint should be opened in a browser, not tested in Postman
- The **Google Callback** is automatically called by Google after authentication
- Use **Complete Profile** after OAuth registration to add additional user details
