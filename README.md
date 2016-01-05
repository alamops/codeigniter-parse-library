# codeigniter-parse-library
A CodeIgniter Framework Parse Library



## Implementing
- User Registration
- User Logout
- User Update
- More Error details





## Attention
**Parse PHP SDK needs default session**, so if you use **CodeIgniter's Session Library I recommend you use PHP Native Session** and let **Parse PHP SDK** initialize it.

I created a [CodeIgniter Native Session](https://github.com/alamops/codeigniter_native_session) Library to it.

_To use Native Session Library with Parse Library in CodeIgniter's Autoload Configuration you need to put first **'parse'** and after **'native_session'**._




## Installing
1. Download [Parse PHP SDK](https://github.com/parseplatform/parse-php-sdk).
2. Create a folder named **parse** on project main folder.
3. Put **Parse PHP SDK** files into **parse** folder.
4. (_Optional_) If you want to use **Parse Library** in all files or many files, I recommend you add it on **CodeIgniter's Autoload Configuration**.




## How to use

### New Object
```php
$className = 'Book';
$newBook = $this->parse->newObject($className);
```
- This retrieves a native Parse Object. So you can use normally how you know.

### Save Object
```php
$newBook = $this->parse->newObject($className);
$this->parse->save($newBook);
```

### Retrieve Object By Id
```php
$className = 'Book';
$bookId = 'jsad71ASdj';
$book = $this->parse->get($className, $bookId);
```

### Find Objects
```php
// find obects normally
$className = 'Author';
$equalToArray = array(
	'active' => TRUE,
);
$ascending = 'name';
$descending = 'null';
$limit = 10;
$skip = 5;
$includeArray = array(
	'country',
);

$authorsResultsArray = $this->parse->find($className, $equalToArray, $ascending, $desceding, $limit, $skip, $includeArray);

// passing Parse Object in equalToArray
$firstAuthor = $authorsResultsArray[0];
$className = 'Book';
$equalToArray = array(
	'author' => $firstAuthor,
);
$ascending = 'publishDate';
$descending = 'null';
$limit = null;
$skip = null;
$includeArray = array();

$booksResultsArray = $this->parse->find($className, $equalToArray, $ascending, $desceding, $limit, $skip, $includeArray);
```

### First Object
- Like _find()_ but without _$limit_ param.
```php

// (...)

$firstAuthor = $authorsResultsArray[0];
$className = 'Book';
$equalToArray = array(
	'author' => $firstAuthor,
);
$ascending = 'publishDate';
$descending = 'null';
$skip = null;
$includeArray = array();

$firstBook = $this->parse->first($className, $equalToArray, $ascending, $desceding, $skip, $includeArray);
```

### User Login
```php
$username = 'example';
$password = 'example';

$user = $this->parse->userLogin($username, $password);
```

### Get Current User
```php
$user = $this->parse->getCurrentUser();
```
