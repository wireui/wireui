<p align="center"><img src="https://wireui.dev/wireui/wireui-circle.png" height="100"></p>

<h2><p align="center">WireUi</p></h2>

<p align="center">
<a href="https://github.com/wireui/wireui/actions"><img src="https://github.com/wireui/wireui/actions/workflows/tests.yml/badge.svg" alt="Tests"></a>
<a href="https://packagist.org/packages/wireui/wireui"><img src="https://img.shields.io/packagist/dt/wireui/wireui" alt="Downloads" /></a>
<a href="license.md"><img src="https://img.shields.io/github/license/wireui/wireui" alt="License" /></a>
<a href="https://x.com/Wire_Ui"><img src="https://img.shields.io/twitter/url?url=https://x.com/Wire_Ui" alt="Twitter"></a>
</p>

### 🌐 RTL / LTR Support (This Fork)

> **Fork:** [hawraz93/wireui-rtl-support](https://github.com/hawraz93/wireui-rtl-support)  
> **Upstream:** [wireui/wireui](https://github.com/wireui/wireui)  
> This work is intended as a Pull Request contribution to the upstream project.

This fork adds **native RTL/LTR support** to WireUI. It contains two categories of changes:

---

#### 1. 🔄 Layout direction — Tailwind logical properties

Fixed directional spacing classes (`ml-`, `pr-`, `pl-`, `mr-`, etc.) are replaced with [Tailwind CSS logical properties](https://tailwindcss.com/docs/margin#using-logical-properties) (`ms-`, `me-`, `ps-`, `pe-`, etc.).

Components will **automatically flip** for right-to-left languages (Arabic, Persian, Kurdish, Hebrew, etc.) when you set `dir="rtl"` on your HTML element — no extra CSS required.

**Affected components:** Alert, DatetimePicker, Dialog, Dropdown, Notifications, Popover, Select, TextField, TimePicker, Wrapper.

---

#### 2. 🔢 Arabic-Indic / Persian / Kurdish digit input support

`<x-wireui-phone>`, `<x-wireui-maskable>`, and `<x-wireui-number>` now accept digits typed in **Arabic-Indic** (`٠١٢٣٤٥٦٧٨٩`) and **Extended Arabic-Indic / Persian / Kurdish** (`۰۱۲۳۴۵۶۷۸۹`) scripts and normalise them to ASCII automatically.

| Component            | Problem                                                       | Fix                                                                                               |
| -------------------- | ------------------------------------------------------------- | ------------------------------------------------------------------------------------------------- |
| `Phone` / `Maskable` | Masker `#` token only matched `/\d/` (ASCII 0–9)              | Token pattern extended to `/[\d\u0660-\u0669\u06F0-\u06F9]/` with a normalising `transform`       |
| `Number`             | `type="number"` blocked non-ASCII digits at the browser level | Switched to `type="text" inputmode="numeric"`, manual `plus()`/`minus()` with `normalizeDigits()` |

**Files changed:**

| File                                              | Change                                                                                     |
| ------------------------------------------------- | ------------------------------------------------------------------------------------------ |
| `ts/utils/helpers.ts`                             | Added `normalizeDigits(value)` — converts Arabic-Indic and Persian/Kurdish digits to ASCII |
| `ts/utils/masker/tokens.ts`                       | `#` token now accepts and normalises Arabic-Indic / Persian digits                         |
| `ts/components/inputs/number.ts`                  | Rewrote `plus()`/`minus()`, added `handleBeforeInput` for on-the-fly digit normalisation   |
| `src/Components/TextField/views/number.blade.php` | `type="number"` → `type="text"`, added `x-on:beforeinput` hook                             |

**How it works end-to-end:**

```
User types ٣ (U+0663)  ──►  beforeinput intercepts  ──►  converted to "3"  ──►  wire:model receives 3
User types ۷ (U+06F7)  ──►  masker #-token matches  ──►  transform → "7"  ──►  masked value is correct
```

---

#### How to verify

**Phone / Maskable:**

```blade
<x-wireui-phone wire:model="phone" label="Phone" />
```

Type `۰۷۵۰١٢٣٤٥٦٧` (mix of Kurdish/Arabic digits) — the mask should apply and the model should receive the ASCII equivalent.

**Number:**

```blade
<x-wireui-number wire:model="count" label="Count" min="0" max="100" />
```

Type `٥` or `۵` — the field should show `5` and the model should receive `5`. The `+`/`−` buttons should still increment/decrement correctly.

**Unit test (Jest/Vitest):**

```ts
import { normalizeDigits } from "@/utils/helpers";

test("normalizes Arabic-Indic digits", () => {
    expect(normalizeDigits("٠١٢٣٤٥٦٧٨٩")).toBe("0123456789");
});

test("normalizes Persian/Kurdish digits", () => {
    expect(normalizeDigits("۰۱۲۳۴۵۶۷۸۹")).toBe("0123456789");
});

test("leaves ASCII digits untouched", () => {
    expect(normalizeDigits("0123456789")).toBe("0123456789");
});
```

**Build:**

```bash
npm run dev   # or: npm run prod
```

No TypeScript errors should appear in the changed files.

---

### 🚀 Introduction

Wire UI is a library of components and resources to empower your Laravel and Livewire application development.

Starting a new project with Livewire can be time-consuming when you have to create all the components from scratch. Wire UI helps to skip this step and get you straight to the development phase.

#### 🔥 You get with Wire UI:

- Form and UI components
- Notifications
- Confirmation notifications
- Card, modals, avatar, buttons, badges, dropdowns, and more
- All Heroicons
- All Phosphor icons

### 📚 Documentation

Documentation for WireUi can be found on the [WireUi website](https://wireui.dev).

### 🔧 Contributing

Thank you for considering contributing to WireUi! The contribution guide can be found in the [WireUi documentation](https://wireui.dev/customize/contribution-guide).

### 📣 Follow the WireUi

Stay informed about WireUI, follow [@Wire_Ui](https://x.com/Wire_Ui) on Twitter and [WireUi](https://www.linkedin.com/company/wireui) on LinkedIn.

There will you see all the latest news about features, ideas, discussions and more...

### 💡 Philosophy

WireUI is and will always be FREE to anyone who would like to use it. This project is created by [Pedro Oliveira](https://github.com/ph7jack), and it is maintained by the author and your team with the help of the community. All contributions are welcome!

### 📝 License

WireUi is open-sourced software licensed under the [MIT license](license.md).

### Powered by

[![JetBrains logo.](https://resources.jetbrains.com/storage/products/company/brand/logos/jetbrains.svg)](https://jb.gg/OpenSource)
