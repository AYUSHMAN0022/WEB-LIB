# Library Management System - Firestore Schema

## Collections

### books
```javascript
{
  id: string,                 // Auto-generated document ID
  title: string,             // Book title
  author: string,            // Book author
  description: string,       // Book description
  fileUrl: string,          // URL to the book file in Firebase Storage
  averageRating: number,    // Average rating (0-5)
  totalRatings: number,     // Total number of ratings
  status: string,           // 'pending_approval' or 'approved'
  createdAt: timestamp,     // Creation timestamp
  updatedAt: timestamp      // Last update timestamp
}
```

### ratings
```javascript
{
  id: string,               // Composite ID: `${bookId}_${userId}`
  bookId: string,          // Reference to the book
  userId: string,          // Reference to the user who rated
  rating: number,          // Rating value (1-5)
  review: string,          // Optional review text
  createdAt: timestamp     // Rating timestamp
}
```

### users
```javascript
{
  id: string,              // User's UID from Firebase Auth
  email: string,           // User's email
  displayName: string,     // User's display name
  photoURL: string,        // User's profile photo URL
  role: string,           // 'user' or 'admin'
  createdAt: timestamp    // Account creation timestamp
}
```

## Indexes

### Single Field Indexes
- books/status
- books/averageRating
- books/createdAt
- ratings/bookId
- ratings/userId
- ratings/rating
- ratings/createdAt

### Composite Indexes
1. books collection:
   - status ASC, createdAt DESC
   - status ASC, averageRating DESC

2. ratings collection:
   - bookId ASC, createdAt DESC
   - userId ASC, rating DESC

## Security Rules
Security rules are defined in `firestore.rules` and ensure:
1. Only authenticated users can read books and ratings
2. Only admins can approve or delete books
3. Users can only create/update their own ratings
4. Users can only manage their own profile data
