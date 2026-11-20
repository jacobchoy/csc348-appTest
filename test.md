---
name: csc348
description: Guidance for the CSC348 Web Application Development coursework and the Plane App Laravel project.
---

# CSC348 Web Application Development

This document is the working reference for the CSC348 coursework and the Plane App. Use it to guide implementation, testing, evidence collection, and submission preparation.

##

This assignment is to a simply created application, without majorly complex concepts being applied. All created code should follow by the rubric and necessary requirements but NOTHING more. 

## Assessment overview


| Component | Weight | Deadline | Submission |
|---|---:|---|---|
| Coursework 1: Database code submission | 20% | 9 November 2026, 2:00 PM | PDF with syntax-highlighted source code |
| Coursework 2: Peer code review | 10% | 17 November 2026, 2:00 PM | PDF with screenshots of five completed reviews |
| Coursework 3a: Functionality demonstration | 42% | 11 December 2026, 2:00 PM | Video, maximum 180 seconds, submitted through the Canvas Quiz |
| Coursework 3b: Theory and implementation brief | 28% | 11 December 2026, 2:00 PM | PDF submitted to Turnitin and a source-code ZIP |

There is no examination. The coursework is intended to demonstrate:

- Effective use of Laravel.
- Independent research into web application development.
- A portfolio-quality web application.
- Understanding of the framework and the implementation decisions.

Late submission results in a mark of zero. Academic integrity and misconduct policies apply.

## Coursework 1: Database code submission

Submit a single PDF containing only the source files relevant to database relationships and seeding. Do not submit the whole project folder.

Include:

- Eloquent models with correctly implemented relationship methods.
- Migrations without syntax or logic errors.
- Seeders that create data and connect related records.
- Factories that generate realistic random data.
- Factories and seeders that generate realistic relationships between records.

The code should follow the required naming conventions, be cleanly formatted, and be easy to follow.

## Coursework 2: Peer code review

Review the Coursework 1 database code of five assigned students within the one-week review period.

Each review should:

- Clearly reference the assigned student's actual code.
- Identify specific strengths and weaknesses.
- Reference the Coursework 1 marking criteria.
- Be constructive, professional, and impersonal.

Avoid general comments that do not demonstrate that the code was read. Aggressive, personal, or unprofessional language can receive no marks.

## Coursework 3a: Functionality video

Submit a video no longer than 180 seconds. The video must show the live working application, not only source code. Provide exact Canvas timestamps for the evidence.

Organize the demonstration around these three rubric categories:

### Progress (20%)

Demonstrate:

- A working web application displaying database items.
- Appropriate formatting and no major bugs.
- Users commenting on existing items.
- Comments being stored and displayed with the relevant items.
- A CSS framework.
- Pagination.
- AJAX used to post comments or update content without a full page reload.
- Additional Laravel or JavaScript functionality beyond the basic lecture material where possible.

### User presence (20%)

Demonstrate:

- User login.
- Items and comments linked to their authors.
- A user profile page showing that user's posts and comments.
- Multiple authorization levels with significantly different permissions.
- Users editing only their own items and comments unless their role permits otherwise.
- Notifications when another user interacts with a post or comment.

### Working with data (20%)

Demonstrate:

- Creating and editing items.
- Validation on a user-created form handled by an independently implemented controller.
- A one-to-one relationship.
- A one-to-many relationship.
- A many-to-many relationship.
- Image upload and display with posts.
- A correctly implemented and appropriately used polymorphic relationship.

## Coursework 3b: Theory and implementation brief

Submit one PDF answering all five questions and a ZIP containing all source files.

The source ZIP **must be named exactly with the student number**, for example:

```text
123456.zip
```

Failure to use the student-number filename can cause the code to be treated as not working.

### Q1: Own code — 6 marks

Give an example of complex code implemented independently. Include screenshots and explain what the code does and why it was designed that way.

### Q2: Git history — 8 marks

Provide screenshots of the Git commit history. The history should demonstrate logical version control over the development period.

### Q3: MVC — 8 marks

Explain MVC using the implementation as evidence. Reference specific models, views, controllers, routes, and related source files with screenshots.

### Q4: WCAG 2 — 8 marks

Reflect on how well the application meets Web Content Accessibility Guidelines 2 requirements. Include screenshots and discuss both successful measures and any limitations.

### Q5: Service container — 10 marks

Explain:

- What a service container is.
- Why dependency injection is useful.
- How the custom service is registered and resolved.
- How the service communicates with an external API.
- How the service is injected into and used by application code.

Include screenshots of the relevant service, binding, dependency injection, API call, and user-facing output.

## Project brief

Create a small Laravel web application in which:

- Users create posts.
- Users comment on their own and other users' posts.
- Different user groups have different permissions.
- The application demonstrates the skills required by the marking scheme.

The chosen project is the **Plane App**, an in-flight passenger utility and social networking application.

## Plane App concept

The app allows passengers to:

- Post rants or updates to a shared social feed.
- Comment on posts.
- View lavatory availability.
- Track how long a lavatory has been occupied.

The app includes separate permissions for passengers and flight attendants.

## Technology decisions

- **Backend:** Laravel and PHP through Laravel Herd.
- **Database:** SQLite during development, with MySQL-compatible migrations where practical.
- **Frontend:** Blade templates and Pico CSS.
- **Dynamic behavior:** JavaScript Fetch API and AJAX polling.
- **Authentication:** Laravel authentication with role-based authorization.

Pico CSS is selected for responsive, semantic, and accessible HTML. The interface should use suitable contrast, labels, headings, keyboard-accessible controls, and meaningful status text.

## Planned data model

### Users

Fields:

- `id`
- `name`
- `email`
- `password`
- `role` (`passenger` or `attendant`)
- `timestamps`

Relationships:

- A user has many posts.
- A user has many comments.
- A user may have a profile or flight details record for the one-to-one requirement.

### Posts

Fields:

- `id`
- `user_id`
- `title`
- `body`
- Image path where required
- `timestamps`

Relationships:

- A post belongs to a user.
- A post has many comments.

### Lavatories

Fields:

- `id`
- `name`, such as `Forward Lavatory A`
- `status`: `vacant`, `occupied`, or `out_of_service`
- `timestamps`

Relationships:

- A lavatory has many occupancy sessions.
- A lavatory may receive polymorphic comments.

### Lavatory sessions

Fields:

- `id`
- `lavatory_id`
- `locked_at`
- `unlocked_at`, nullable

Relationships:

- A session belongs to a lavatory.

An open session represents current occupancy. The difference between `locked_at` and `unlocked_at`, or the current time for an open session, can be used to calculate occupancy duration.

### Comments

Fields:

- `id`
- `user_id`
- `body`
- `commentable_id`
- `commentable_type`
- `timestamps`

Relationships:

- A comment belongs to a user.
- A comment morphs to its commentable model.
- Posts and lavatories can both receive comments.

This polymorphic relationship provides evidence for the Working with Data rubric.

## Authorization plan

### Passengers

Passengers can:

- View the social feed.
- Create posts.
- View lavatory status.
- Comment on posts and lavatories.
- Edit or delete their own posts and comments.

### Flight attendants or administrators

Attendants inherit passenger abilities and can additionally:

- Access an administrative dashboard.
- Override lavatory status.
- Mark a lavatory as out of service for maintenance.
- Manage content where an authorization policy permits it.

Implement authorization using Laravel gates or policies. Authorization must be enforced server-side, not only hidden in the interface.

## Dynamic UI plan

### Lavatory status polling

Create a dedicated endpoint such as:

```text
/api/lavatories/status
```

Use a JavaScript `fetch()` interval, targeting approximately five seconds, to update:

- Vacant, occupied, or out-of-service indicators.
- The active occupancy timer.
- Any relevant status text.

The update must happen without a full page reload and should handle failed requests visibly rather than silently displaying stale success data.

### AJAX comments

Use Fetch API requests to submit comments and update the relevant post or lavatory in place. Validate the request on the server and return a clear JSON response for both success and validation errors.

## External API and service-container plan

Create a `FlightDataService` that retrieves flight telemetry such as:

- Current altitude.
- Ground speed.
- Estimated time of arrival.

The service should:

1. Encapsulate the external API request.
2. Be registered or bound through `AppServiceProvider`.
3. Be injected into a controller or other application service.
4. Handle configuration through environment variables.
5. Expose useful data to the application without leaking HTTP implementation details into views.
6. Display flight information in the application navigation or another visible Plane App area.

Possible providers include AviationStack, FlightAware, or a simulated mock API when external access is unavailable. The implementation and PDF must clearly explain dependency injection and the service-container design.

## Implementation checklist

### Database and Coursework 1

- [ ] Confirm migrations run successfully from a clean database.
- [ ] Confirm every model has the required fillable or guarded configuration.
- [ ] Implement and test all required Eloquent relationships.
- [ ] Add realistic factories.
- [ ] Seed related records, not only isolated records.
- [ ] Run the database seeder successfully.
- [ ] Export only the required database source files for the Coursework 1 PDF.

### Core application

- [ ] Add authentication.
- [ ] Add passenger and attendant roles.
- [ ] Build posts and comments.
- [ ] Add server-side validation.
- [ ] Add policies or gates.
- [ ] Add profile pages showing posts and comments.
- [ ] Add notifications.

### Rubric evidence

- [ ] Add pagination.
- [ ] Add Pico CSS or another appropriate CSS framework.
- [ ] Add AJAX comment submission.
- [ ] Add AJAX lavatory polling.
- [ ] Implement one-to-one, one-to-many, many-to-many, and polymorphic relationships.
- [ ] Add image upload and display.
- [ ] Test WCAG 2 considerations and capture screenshots.
- [ ] Build and test `FlightDataService`.
- [ ] Capture logical Git history throughout development.

### Submission preparation

- [ ] Record a video no longer than 180 seconds.
- [ ] Show functionality in the order: Progress, User presence, Working with data.
- [ ] Record exact timestamps for every demonstrated rubric item.
- [ ] Answer all five Coursework 3b questions.
- [ ] Include screenshots tied to specific source files and features.
- [ ] Export the theory brief as one PDF.
- [ ] Create the source ZIP using exactly the student number as its filename.
- [ ] Verify that the ZIP contains the required source files without unnecessary secrets or generated dependencies.

## Working principles

- Preserve clear Laravel conventions.
- Prefer small, testable changes.
- Keep authorization and validation on the server.
- Make errors visible and actionable.
- Use realistic seeded data to make every feature demonstrable.
- Keep commits logical and descriptive.
- Build each feature so it can be shown clearly in the video and explained in the theory brief.

## Coursework 3a: Full rubric and submission checklist

The functionality quiz requires four submission items: a ZIP of all source files, an up-to-180-second evidence video, a prompt diary PDF, and the application name.

The source ZIP must be named exactly as the student number, for example `123456.zip`. A ZIP with any other filename may be treated as not meeting basic requirements and therefore as not working code.

### Quiz evidence areas

The final application must demonstrate the following items. The timestamps below are not needed for the planning stage, but they must be recorded while filming the final video.

#### Progress

- [ ] A database-backed list of items is formatted appropriately and has no major bugs.
- [ ] Users can comment on existing items.
- [ ] New comments are stored and displayed alongside the relevant item.
- [ ] A CSS framework is used for the interface.
- [ ] Pagination is used to present posts or other collections effectively.
- [ ] AJAX or Fetch API is used to submit comments or update content without a full reload.
- [ ] The application uses Laravel or JavaScript features beyond the basic lecture material.

#### User presence

- [ ] Users can log in.
- [ ] Posts and comments clearly show their authors.
- [ ] Clicking an author's name opens a profile containing that user's posts and comments.
- [ ] User roles provide significantly different permissions.
- [ ] Passengers can only edit their own posts and comments.
- [ ] Attendants or administrators can receive broader permissions.
- [ ] Server-side policies or gates enforce all ownership and role rules.
- [ ] Users receive notifications when another user interacts with their post or comment.

#### Working with data

- [ ] Users can create posts without major bugs.
- [ ] Users can edit their own posts without major bugs.
- [ ] Validation is demonstrated on an independently implemented post or comment controller.
- [ ] One-to-one relationship is implemented and usable.
- [ ] One-to-many relationship is implemented and usable.
- [ ] Many-to-many relationship is implemented and usable.
- [ ] Users can upload an image with a post.
- [ ] Uploaded images are stored securely and displayed with posts.
- [ ] Polymorphic comments are implemented and used on both posts and lavatories.
- [ ] Polymorphic comments can be created and displayed in the application.

### Required quiz uploads

- [ ] Source-code ZIP named with the student number.
- [ ] Evidence video no longer than 180 seconds.
- [ ] Prompt diary PDF with AI-assisted code entries.
- [ ] Application name recorded in the quiz.

## Coursework 3b: Exact theory and implementation answers

The final theory PDF must answer all five questions as a single PDF and must be supported by screenshots.

### Q1 — Own code (6 marks)

- [ ] Select one genuinely independent, substantial implementation.
- [ ] Explain what the code does and how it works.
- [ ] Explain the design decision behind the implementation.
- [ ] Include syntax-highlighted or clearly legible screenshots.
- [ ] Suggested evidence: comment AJAX validation, lavatory polling, role authorization, or `FlightDataService`.

### Q2 — Git history (8 marks)

- [ ] Capture screenshots of the commit history.
- [ ] Use logical, descriptive commits throughout development.
- [ ] Ensure the history shows progress over time rather than one final commit.
- [ ] Arrange screenshots so the commit messages and relevant file changes are readable.

### Q3 — MVC (8 marks)

- [ ] Explain the Model, View, and Controller responsibilities.
- [ ] Link a real route to a controller action.
- [ ] Reference the relevant Eloquent model and relationships.
- [ ] Reference the Blade view rendered by the controller.
- [ ] Include screenshots of each relevant source area.
- [ ] Explain data flow from route through controller and model to view.

### Q4 — WCAG 2 (8 marks)

- [ ] Audit the application against relevant Web Content Accessibility Guidelines 2 criteria.
- [ ] Include screenshots showing successful implementation.
- [ ] Discuss semantic headings and landmarks.
- [ ] Check labels, accessible form names, and clear error messages.
- [ ] Check keyboard navigation and visible focus.
- [ ] Check text and control contrast.
- [ ] Check status announcements for dynamic AJAX and polling updates.
- [ ] Check image alternatives and meaningful link text.
- [ ] Clearly identify any remaining limitations rather than claiming full compliance.

### Q5 — Service container (10 marks)

- [ ] Explain the Laravel service container concept.
- [ ] Explain dependency injection and why it improves external API integration.
- [ ] Show the custom service implementation.
- [ ] Show registration or binding in `AppServiceProvider`.
- [ ] Show injection into a controller or application service.
- [ ] Show the external API HTTP call or simulated API call.
- [ ] Show environment-based configuration.
- [ ] Show the resulting flight data in the user interface.
- [ ] Explain HTTP implementation boundaries and error handling.

## Prioritized implementation plan

### Phase 1 — Make the database a clean foundation

1. Rebuild the database from scratch and run migrations:

```bash
php artisan migrate:fresh --seed
```

2. Fix and verify the post, profile, comment, lavatory, and lavatory-log schemas.
3. Verify all fillable fields and casts.
4. Verify and test:
   - User has one Profile.
   - User has many Posts.
   - User has many Comments.
   - Post has many Comments.
   - User belongs to many saved Posts and Posts belong to many saved Users.
   - Post and Lavatory both receive polymorphic Comments.
5. Add factories and seeding for realistic users, posts, comments, profiles, lavatories, logs, and relationships.
6. Add focused model and database tests.

**Exit condition:** `migrate:fresh --seed` succeeds repeatedly and the required relationships can be demonstrated in Tinker or tests.

### Phase 2 — Build the MVC application

1. Create controllers for feed, posts, comments, profiles, lavatories, and flight data.
2. Add resource or named routes.
3. Build Blade layouts and pages:
   - Application layout.
   - Logged-in feed.
   - Post detail.
   - Create/edit post form.
   - User profile.
   - Lavatory status dashboard.
4. Add authentication and protect required routes.
5. Apply Pico CSS or another appropriate framework to semantic HTML.
6. Add pagination to the post collection.

**Exit condition:** A logged-out user is redirected appropriately, and logged-in users can navigate the complete application.

### Phase 3 — Implement authorization

1. Add passenger and attendant roles.
2. Create policies for posts and comments.
3. Prevent users from updating or deleting content they do not own.
4. Add attendant permissions that differ significantly from passenger permissions.
5. Enforce rules in controllers and policies, not just Blade conditions.
6. Add authorized tests for owner, other passenger, and attendant behavior.

**Exit condition:** Role and ownership rules produce correct results server-side for all relevant actions.

### Phase 4 — Implement posts and comments

1. Create server-side validated post creation and editing.
2. Create comment creation and validation.
3. Add AJAX comment submission with Fetch API.
4. Return JSON success, validation errors, and authorization errors.
5. Update the comment area in the DOM without reloading the page.
6. Display clear, accessible failure messages.

**Exit condition:** Users can create, validate, edit, and comment on content through working UI flows.

### Phase 5 — Implement media and dynamic data

1. Add image upload fields and validation.
2. Store uploaded images outside public source code using Laravel storage.
3. Create the public storage link.
4. Display image alternatives and post images.
5. Implement lavatory status updates.
6. Add Fetch polling at approximately five-second intervals.
7. Prevent stale or misleading status displays when a request fails.
8. Use a dedicated status endpoint for lavatory data.

**Exit condition:** Uploaded images and live lavatory status remain correct after refresh and network failures.

### Phase 6 — Implement notifications

1. Add a notification when a user comments on someone else's post.
2. Consider notifications for other post or comment interactions.
3. Build a notification list or unread count in the UI.
4. Mark notifications as read.
5. Test notification creation and recipient selection.

**Exit condition:** Notifications are persisted, visible to the intended recipient, and demonstrable in the video.

### Phase 7 — Implement the external API service

1. Create a `FlightDataService` interface and implementation or a clear concrete service.
2. Keep HTTP requests and configuration out of views.
3. Configure credentials and endpoint through environment variables.
4. Use a service binding or singleton in `AppServiceProvider`.
5. Inject the service into a controller or application service.
6. Add timeout, status, and invalid-response handling.
7. Add a safe fallback or simulated API for unavailable external access.
8. Display a user-facing flight status area.

**Exit condition:** Flight data is returned through dependency injection and no external HTTP details leak into views.

### Phase 8 — Add automated tests

Add small focused tests for:

- Database migrations and seeding.
- Required relationships.
- Authentication.
- Post and comment validation.
- Owner-only editing.
- Attendant permissions.
- Image validation/upload.
- AJAX JSON responses.
- Notification creation.
- Flight service behavior and fallback handling.

Run:

```bash
php artisan test
```

**Exit condition:** The relevant feature tests pass from a clean database.

### Phase 9 — Accessibility review

1. Audit every form, navigation area, feed item, status indicator, and modal or dynamic region.
2. Check semantic heading order and landmarks.
3. Add accessible names and explicit form labels.
4. Verify keyboard operation and visible focus.
5. Verify text/control contrast.
6. Make AJAX success, validation, and polling results available to assistive technology.
7. Add meaningful image descriptions and link text.
8. Capture before-and-after screenshots for the theory brief.

**Exit condition:** The application has no obvious major WCAG 2 issues and remaining limitations are documented honestly.

### Phase 10 — Evidence capture

1. Commit work in small, descriptive development units.
2. Prepare realistic seeded accounts for passenger and attendant demonstrations.
3. Record the 180-second functionality video in one continuous take or with carefully planned sections.
4. Demonstrate items in this order:
   - Progress.
   - User presence.
   - Working with data.
5. Capture source screenshots for MVC, AJAX, relationships, authorization, uploads, and external API integration.
6. Record the theory PDF answers and all screenshots.
7. Build the prompt diary PDF with every AI-generated code entry formatted as:
   - `DATE:`
   - `MODEL:`
   - `PROMPT:`
   - `CODE:`
   - `EXPLANATION:`
8. Confirm the prompt diary explanation proves understanding, not merely repetition.

**Exit condition:** Every rubric claim in the video or PDF has readable, current evidence.

## Current implementation assessment

The repository has an initial data model, migrations, factories, seeders, and relationship methods. The next project risk is that a database model alone does not satisfy the application requirements: controllers, routes, Blade views, authentication, policies, AJAX, uploads, notifications, and the external API service are still required.

Before implementation, verify and complete:

- [ ] All migrations run from a clean database.
- [ ] The seeder creates consistent realistic data.
- [ ] Authentication is configured and demonstrable.
- [ ] Passenger and attendant roles are enforced.
- [ ] All required user interfaces exist.
- [ ] Focused tests cover the core rubric behavior.

