require 'pg'
require 'csv'
require 'active_support/core_ext/string/inflections'

begin
  db = PG.connect dbname: 'seng_401_lab04', user: 'postgres', password: 'postgres'
  csv = CSV.read('SENG401-Lab4-Books.csv', headers: true)
  csv.each do |book|
    isbn = db.escape_string(book['ISBN'].strip)
    name = db.escape_string(book['Name'].strip)
    publication_year = book['Year'].to_i
    publisher = db.escape_string(book['Publisher'].strip)
    image = db.escape_string(book['Image'].strip)

    authors = []
    book['Authors'].split(',').each do |author|
      author = author.gsub(/&amp/, '')
      author = author.strip
      author = db.escape_string(author.titleize)
      authors << author
    end

    created_at = Time.now.getutc
    updated_at = created_at
    db.exec "INSERT INTO books(name, isbn, publication_year, publisher, image, created_at, updated_at) VALUES('#{name}', '#{isbn}', #{publication_year}, '#{publisher}', '#{image}', '#{created_at}', '#{updated_at}') ON CONFLICT DO NOTHING"

    authors.each do |author|
      db.exec "INSERT INTO authors(name, created_at, updated_at) VALUES('#{author}', '#{created_at}', '#{updated_at}') ON CONFLICT DO NOTHING"

      results = db.exec "SELECT id FROM books WHERE isbn = '#{isbn}'"
      book_id = results.first['id'].to_i

      results = db.exec "SELECT id FROM authors WHERE name = '#{author}'"
      author_id = results.first['id'].to_i

      db.exec "INSERT INTO author_book(book_id, author_id, created_at, updated_at) VALUES(#{book_id}, #{author_id}, '#{created_at}', '#{updated_at}') ON CONFLICT DO NOTHING"
    end
  end
rescue PG::Error => e
  puts e.message
ensure
  db.close if db
end
