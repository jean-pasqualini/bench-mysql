LOAD DATA INFILE and extended INSERTs each have their distinct advantages.

LOAD DATA INFILE is designed for mass loading of table data in a single operation along with bells and whistles to perform tings like:

Skipping Initial Lines
Skipping Specific Columns
Transforming Specific Columns
Loading Specific Columns
Handling Duplicate Key Issues
Less overhead is needed for parsing

On the flip side, if you are only importing 100 rows instead of 1,000,000 rows, extended INSERT is sensible.

Notice that mysqldump was designed around extended INSERTs for the sake of carrying table design along with data as it performs the injection of hundreds or thousands of rows per INSERT. LOAD DATA INFILE always creates a physical dichomoty between schema and data.

From an application point-of-view, LOAD DATA INFILE is also more insensitive to schema change than extended INSERTs.

One can go back and forth on the good, the bad, and ugly of using LOAD DATA INFILE. No matter which technique you use, you must always set the bulk_insert_buffer_size. Why?

According to the MySQL Documentation on bulk_insert_buffer_size:

MyISAM uses a special tree-like cache to make bulk inserts faster for INSERT ... SELECT, INSERT ... VALUES (...), (...), ..., and LOAD DATA INFILE when adding data to nonempty tables. This variable limits the size of the cache tree in bytes per thread. Setting it to 0 disables this optimization. The default value is 8MB.

For years, I have seen client after client not set this and leave it at 8MB. Then, when they decide to use LOAD DATA INFILE or import mysqldumps, they can sense something wrong. I usually recommend setting this to a moderate 256M. In some cases, 512M.

Once you have a big enough bulk INSERT buffer, using either technique is rendered academic and boils down to personal choice. For applications where you bulk INSERT just 100 rows on demand, stick with extended INSERTs.

In all fairness, saying LOAD DATA INFILE is faster that normal INSERT statements is kind of a loaded statement mainly because configuration is not taken into account. Even if you setup a benchmark between LOAD DATA INFILE and extended INSERTs with a proper bulk_insert_buffer_size, the nanoseconds saved on parsing each row can only yield nominal results at best in favor of LOAD DATA INFILE.

Go ahead and add this to my.cnf

[mysqld]
bulk_inset_buffer_size=256M
You could also set it just for your session before launching extended INSERTs

SET bulk_insert_buffer_size= 1024 * 1024 * 256;
UPDATE 2012-07-19 14:58 EDT
To keep things in perspective, the bulk insert buffer is only useful for loading MyISAM tables, not InnoDB. I wrote a more recent post on bulk loading InnoDB : Mysql load from infile stuck waiting on hard drive