from fastapi import FastAPI
from parse import get_stock_prices

app = FastAPI()


@app.get("/get-price/{ticker}")
def stock_price(ticker: str):
    """Get current stock price for a given ticker"""
    return get_stock_prices(ticker)
