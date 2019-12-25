# Task

- Scenario 1: Dev pushed a branch for testing. QA bounced it back with reason after testing on Server 1. Dev didn't find any issue when testing on his platform. How would you handle the case?

- Scenario 2: Server A has all services (including internal Email Service) for an App to work. At some point the App is overloaded. What would you do to optimize system?

- Test 1: Write an Employee Payment System in Laravel that will use Auth Service (on different server) for authentication. 
    - There will be an App on Laravel holding Employee information. 
    - This App will be connection to Payment System for basic CRUD operations for each employee.
    - On App, Employee should be able to see his salary details
    - Admin should be able to see all employees with their last salary detail, total salary per year.

-> Answer
...

- Test 2: Build a Laravel App that's optimized to send 100 Emails per second via API.

-> Answer
1. Setup Queue Redis
2. Provide API endpoint, e.g: /api/fast-email (accepts emails parameter)
3. Somewhere controller call that API
4. API will process received emails loop it then trigger to the queue. (1 queue handle 1 sending email)