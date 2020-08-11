const decimals = (n) => {
  const s = n.toString();
  const match = /(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/.exec(s);
  if (!match) { return 0; }
  return Math.max(0, (match[1] === '0' ? 0 : (match[1] || '').length) - (match[2] || 0));
};

const amount = (amount) => {
  if (amount && decimals(amount) >= 2) {
    return Number.parseFloat(amount).toFixed(2);
  }
  return amount;
};

export default {
  amount,
  decimals,
};
