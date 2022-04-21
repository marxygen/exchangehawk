CREATE TABLE IF NOT EXISTS stocks (
    symbol VARCHAR(8) PRIMARY KEY,
    name VARCHAR(50),
    price REAL
);

CREATE TABLE IF NOT EXISTS stock_prices (
    stock_symbol VARCHAR(50) FOREIGN KEY REFERENCES stocks(symbol) ON DELETE CASCADE,
    timestamp TIMESTAMPTZ,
    price REAL,
    PRIMARY KEY (stock_symbol, timestamp)
);

CREATE TABLE IF NOT EXISTS users (
    id BIGSERIAL PRIMARY KEY,
    username VARCHAR(50),
    password_hash VARCHAR(64)
);

CREATE TABLE IF NOT EXISTS user_stocks (
    user_id BIGINT NOT NULL,
    stock_symbol VARCHAR(8) NOT NULL,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (stock_symbol) REFERENCES stocks(symbol),
);