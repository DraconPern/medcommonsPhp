ALTER TABLE users
ALTER COLUMN acctype SET DEFAULT 'SPONSORED';

UPDATE users
SET acctype='SPONSORED'
WHERE sha1 IS NULL AND email IS NULL;
