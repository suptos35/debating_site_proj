# AI Reference Checking Setup

## Overview
The AI reference checking system validates whether reference URLs actually support the claims made in posts. It uses Hugging Face's free inference API for semantic analysis.

## Setup Instructions

### 1. Get Hugging Face API Token (Free)
1. Go to https://huggingface.co/settings/tokens
2. Create a new token with "Read" access
3. Copy your token

### 2. Add to .env file
Add this line to your `.env` file:
```
HUGGINGFACE_API_TOKEN=your_token_here
```

### 3. Console Commands
Run AI analysis on references:
```bash
# Check all references that need analysis
php artisan references:check-ai

# Check specific reference by ID
php artisan references:check-ai --id=1

# Force check all references (ignore last_checked_at)
php artisan references:check-ai --force
```

### 4. Manual AI Check
Users can manually trigger AI analysis by clicking the "🤖 Check" button next to references in the arguments view.

## How It Works
1. **Content Extraction**: Downloads content from reference URLs using HTTP client
2. **Semantic Analysis**: Uses Hugging Face models for text similarity and classification
3. **Fallback Analysis**: Uses keyword matching if AI models are unavailable
4. **Database Storage**: Results stored in `ai_analysis`, `supports_post`, `confidence_score` columns
5. **UI Display**: Shows badges (🤖 Supports/Contradicts/Pending) based on analysis results

## AI Models Used
- Semantic Similarity: `sentence-transformers/all-MiniLM-L6-v2`
- Text Classification: `cardiffnlp/twitter-roberta-base-sentiment-latest`

## Badge Meanings
- 🤖 **Supports**: AI determined the reference supports the post content
- 🤖 **Contradicts**: AI determined the reference contradicts the post content  
- 🤖 **Pending**: AI analysis has not been performed yet

## Confidence Scores
Results include confidence scores (0-1) indicating how certain the AI is about its analysis. Higher scores mean more confident predictions.

## Rate Limiting
The system includes:
- 1-second delays between API calls
- Graceful fallback to keyword analysis if API fails
- Non-blocking integration (failures don't prevent reference creation)

## Files Modified/Added
- `app/Services/FreeAIReferenceService.php` - Core AI service
- `app/Console/Commands/CheckReferencesAI.php` - Console command for batch processing
- `database/migrations/*_add_ai_support_to_references_table.php` - Database schema
- `app/Models/Reference.php` - Model updates for AI fields
- `app/Http/Controllers/ReferenceController.php` - Manual AI check integration
- `resources/views/components/arguments.blade.php` - UI badges and buttons
- `config/services.php` - Hugging Face API configuration
