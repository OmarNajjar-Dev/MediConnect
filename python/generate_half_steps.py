# Generate all values from 0 to 200 including .5 steps
values = []

for i in range(0, 401):
    number = i * 0.5
    if number.is_integer():
        values.append(str(int(number)))
    else:
        values.append(str(number))

# Print in single line
print('"' + '", "'.join(values) + '"')