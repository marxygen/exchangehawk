from fastapi import FastAPI
from parse import get_stock_prices

app = FastAPI()


@app.get("/get-price/{ticker}")
def stock_price(ticker: str):
    """Get stock price for given ticker"""
    return get_stock_prices(ticker)
