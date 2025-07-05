# إعادة إنشاء الملف final_tailwind_spacing_with_gap_auto.css بنفس المحتوى السابق

# القيم من 0 إلى 28 بفواصل 0.5 + "auto"
values = [f"{x/2}".rstrip('0').rstrip('.') if x % 2 == 0 else f"{x/2}" for x in range(0, 57)]
values += ["auto"]

# البادئات المطلوبة
priority_1_prefixes = ["pt-", "pb-", "pl-", "pr-", "mt-", "mb-", "ml-", "mr-"]
priority_2_prefixes = ["px-", "py-", "mx-", "my-"]
priority_3_prefixes = ["p-", "m-"]
gap_prefixes = ["gap-", "gap-x-", "gap-y-"]

# دوال توليد الكلاسات
def generate_classes(prefixes):
    return [f"{prefix}{v}" for v in values for prefix in prefixes]

priority_3_classes = generate_classes(priority_3_prefixes)
priority_2_classes = generate_classes(priority_2_prefixes)
priority_1_classes = generate_classes(priority_1_prefixes)
gap_classes = generate_classes(gap_prefixes)

# ترتيب الأولوية: الأقل أولاً (كما طلب المستخدم)
all_classes_with_gap = priority_3_classes + priority_2_classes + priority_1_classes + gap_classes

# دوال إنشاء كود CSS
def generate_css_block(class_name):
    prop = "padding" if class_name.startswith("p") else "margin"
    direction = {
        "t": "-top",
        "b": "-bottom",
        "l": "-left",
        "r": "-right",
        "x": ["-left", "-right"],
        "y": ["-top", "-bottom"]
    }

    for suffix in ["t", "b", "l", "r", "x", "y"]:
        if f"{prop[0]}{suffix}-" in class_name:
            prefix = f"{prop[0]}{suffix}-"
            value = class_name[len(prefix):]
            break
    else:
        prefix = f"{prop[0]}-"
        value = class_name[len(prefix):]

    css_val = "auto" if value == "auto" else f"calc(var(--space-unit) * {value})"

    css_lines = []
    if prefix.endswith("x-"):
        css_lines.append(f"{prop}-left: {css_val};")
        css_lines.append(f"{prop}-right: {css_val};")
    elif prefix.endswith("y-"):
        css_lines.append(f"{prop}-top: {css_val};")
        css_lines.append(f"{prop}-bottom: {css_val};")
    elif prefix.endswith("-"):
        css_lines.append(f"{prop}: {css_val};")
    else:
        short = prefix[1]
        css_lines.append(f"{prop}-{short}: {css_val};")

    class_selector = "." + class_name.replace(".", "\\.")
    block = f"{class_selector} {{\n"
    for line in css_lines:
        block += f"  {line}\n"
    block += "}"
    return block

def generate_gap_css_block(class_name):
    if class_name.startswith("gap-x-"):
        prop = "column-gap"
        value = class_name.replace("gap-x-", "")
    elif class_name.startswith("gap-y-"):
        prop = "row-gap"
        value = class_name.replace("gap-y-", "")
    else:
        prop = "gap"
        value = class_name.replace("gap-", "")

    css_val = "auto" if value == "auto" else f"calc(var(--space-unit) * {value})"
    class_selector = "." + class_name.replace(".", "\\.")
    block = f"{class_selector} {{\n  {prop}: {css_val};\n}}"
    return block

# بناء الملف الكامل
css_output_full_auto = ":root {\n  --space-unit: 4px;\n}\n\n"

for cls in all_classes_with_gap:
    if cls.startswith("gap"):
        css_output_full_auto += generate_gap_css_block(cls) + "\n\n"
    else:
        css_output_full_auto += generate_css_block(cls) + "\n\n"

# حفظ الملف
final_output_auto_path = "./spacing.min.css"
with open(final_output_auto_path, "w", encoding="utf-8") as f:
    f.write(css_output_full_auto)

final_output_auto_path
