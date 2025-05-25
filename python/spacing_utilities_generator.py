from pathlib import Path

# Base spacing values including 'auto'
spacing_values = [
    "auto",
    "0",
    "0.5",
    "1",
    "1.5",
    "2",
    "2.5",
    "3",
    "3.5",
    "4",
    "4.5",
    "5",
    "5.5",
    "6",
    "6.5",
    "7",
    "7.5",
    "8",
    "8.5",
    "9",
    "9.5",
    "10",
    "10.5",
    "11",
    "11.5",
    "12",
    "12.5",
    "13",
    "13.5",
    "14",
    "14.5",
    "15",
    "15.5",
    "16",
    "16.5",
    "17",
    "17.5",
    "18",
    "18.5",
    "19",
    "19.5",
    "20",
    "20.5",
    "21",
    "21.5",
    "22",
    "22.5",
    "23",
    "23.5",
    "24",
    "24.5",
    "25",
    "25.5",
    "26",
    "26.5",
    "27",
    "27.5",
    "28",
]

# Directions for margin and padding
directions = {
    "": "",  # all
    "t": "-top",
    "r": "-right",
    "b": "-bottom",
    "l": "-left",
    "x": ["-left", "-right"],
    "y": ["-top", "-bottom"],
}


# Generate CSS using calc and --space-unit
def generate_calc_spacing_utilities():
    lines = [
        "/* ============================================= */",
        "/*        Spacing Utilities (Auto-generated)     */",
        "/*        Powered by: --space-unit: 4px;         */",
        "/* ============================================= */",
        "",
        ":root {",
        "  --space-unit: 4px;",
        "}",
        "",
    ]

    props = {"m": "margin", "p": "padding"}

    for short, full in props.items():
        lines.append(f"\n/* ------------------- */")
        lines.append(f"/* {full.capitalize()} Utilities */")
        lines.append(f"/* ------------------- */\n")
        for value in spacing_values:
            safe_value = value.replace(".", "\\.")
            for d_key, d_val in directions.items():
                class_name = f".{short}{d_key}-{safe_value}"
                if value == "auto":
                    rule_value = "auto"
                else:
                    rule_value = f"calc(var(--space-unit) * {value})"

                if isinstance(d_val, list):
                    rules = "\n".join(
                        [f"  {full}{dir_}: {rule_value};" for dir_ in d_val]
                    )
                else:
                    rules = f"  {full}{d_val}: {rule_value};"
                lines.append(f"{class_name} {{\n{rules}\n}}\n")

    # Gap utilities
    lines.append(f"\n/* -------------------- */")
    lines.append(f"/* Gap Utilities */")
    lines.append(f"/* -------------------- */\n")
    for value in spacing_values:
        if value == "auto":
            continue  # gap cannot be auto
        safe_value = value.replace(".", "\\.")
        rule_value = f"calc(var(--space-unit) * {value})"
        lines.append(f".gap-{safe_value} {{\n  gap: {rule_value};\n}}\n")
        lines.append(f".gap-x-{safe_value} {{\n  column-gap: {rule_value};\n}}\n")
        lines.append(f".gap-y-{safe_value} {{\n  row-gap: {rule_value};\n}}\n")

    return "\n".join(lines)


# Generate CSS content
css_calc_output = generate_calc_spacing_utilities()

# Save to file (local accessible path)
output_path = Path("C:/Users/BlueSky/Desktop/spacing-utilities.css")
output_path.write_text(css_calc_output)

output_path.name
