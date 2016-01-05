# codeigniter-parse-library
A CodeIgniter Framework Parse Library




## Attention
**Parse PHP SDK needs default session**, so if you use **CodeIgniter's Session Library I recommend you use PHP Native Session** and let **Parse PHP SDK** initialize it.

I created a [CodeIgniter Native Session](https://github.com/alamops/codeigniter_native_session) Library to it.

_To use Native Session Library with Parse Library in CodeIgniter's Autoload Configuration you need to put first **'parse'** and after **'native_session'**._




## Installing
1. Download [Parse PHP SDK](https://github.com/parseplatform/parse-php-sdk).
2. Create a folder named **parse** on project main folder.
3. Put **Parse PHP SDK** files into **parse** folder.
4. (_Optional_) If you want to use **Parse Library** in all files or many files, I recommend you add it on **CodeIgniter's Autoload Configuration**.